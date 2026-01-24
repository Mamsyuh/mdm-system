<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDataPenduduk extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('seeders/csv/data_penduduk.csv');

        if (!file_exists($file)) {
            $this->command->error("File tidak ditemukan!");
            return;
        }

        $handle = fopen($file, "r");
        $header = fgetcsv($handle, 0, ";"); // Skip Header

        $count = 0;
        $skipped = 0;
        $kkData = [];

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                $data = array_combine($header, $row);

                /** =============================
                 *  PARSE TANGGAL LAHIR
                 *  =============================
                 */
                $tglLahir = DateTime::createFromFormat('d/m/Y H:i', $data['TGL_LHR']);
                if (!$tglLahir) {
                    $skipped++;
                    continue;
                }

                /** =============================
                 *  JENIS KELAMIN
                 *  =============================
                 */
                $jk = strtolower($data['JENIS_KELAMIN']) === 'laki-laki' ? 'L' : 'P';

                /** =============================
                 *  HITUNG TANGGAL UNTUK NIK
                 *  =============================
                 */
                $tglNik = (int) $tglLahir->format('d');
                if ($jk === 'P') {
                    $tglNik += 40;
                }

                /** =============================
                 *  GENERATE NIK
                 *  =============================
                 */
                $nik = substr($data['NIK'], 0, 6)
                    . str_pad($tglNik, 2, '0', STR_PAD_LEFT)
                    . $tglLahir->format('m')
                    . substr($tglLahir->format('Y'), -2)
                    . '0001';

                if (strlen($nik) !== 16) {
                    $skipped++;
                    continue;
                }

                /** =============================
                 *  GENERATE NO KK
                 *  =============================
                 */

                $noKkAsli = $data['NO KK'];
                $isKepala = strtolower($data['STATUS_HUBUNGAN_DLM_KELUARGA']) === 'kepala keluarga';

                if (!isset($kkData[$noKkAsli])) {
                    $kkData[$noKkAsli] = [
                        'prefix' => null,
                        'counter' => 0
                    ];
                }

                if ($isKepala && $kkData[$noKkAsli]['prefix'] === null) {

                    $hari  = $tglLahir->format('d');
                    $bulan = $tglLahir->format('m');
                    $tahun = $tglLahir->format('y');

                    $kkData[$noKkAsli]['prefix'] = $hari . $bulan . $tahun;
                }

                $kkData[$noKkAsli]['counter']++;

                $urutan = str_pad(
                    $kkData[$noKkAsli]['counter'],
                    4,
                    '0',
                    STR_PAD_LEFT
                );

                $noKkBaru = substr($noKkAsli, 0, 6) . $kkData[$noKkAsli]['prefix'] . $urutan;

                if ($isKepala) {
                    $kk = KartuKeluarga::updateOrCreate(
                        ['no_kk' => $noKkBaru],
                        [
                            'kepala_keluarga' => $data['NAMA_KEP_KEL'],
                            'alamat' => $data['ALAMAT'],
                            'rt' => $data['RT'],
                            'rw' => $data['RW']
                        ]
                    );
                }

                /** =============================
                 *  HITUNG USIA
                 *  =============================
                 */
                $usia = Carbon::parse($tglLahir->format('Y-m-d'))->age;

                /** =============================
                 *  PENDUDUK
                 *  =============================
                 */
                Penduduk::updateOrCreate(
                    ['nik' => $nik],
                    [
                        'kecamatan' => $data['NAMA_KEC'],
                        'desa' => $data['NAMA_KEL'],
                        'no_kk' => $noKkBaru,
                        'kk_id' => $kk->id,
                        'kepala_keluarga' =>
                        strtolower($data['STATUS_HUBUNGAN_DLM_KELUARGA']) === 'kepala keluarga'
                            ? 'Iya'
                            : 'Tidak',

                        'alamat' => $data['ALAMAT'],
                        'rt' => $data['RT'],
                        'rw' => $data['RW'],
                        'nama' => $data['NAMA_LENGKAP_ANGGOTA KELUARGA'],
                        'nik' => $nik,
                        'tempat_lahir' => $data['TMPT_LHR'],
                        'tanggal_lahir' => $tglLahir->format('Y-m-d'),
                        'jenis_kelamin' => $jk,
                        'hubungan_keluarga' => strtoupper($data['STATUS_HUBUNGAN_DLM_KELUARGA']),
                        'agama' => strtoupper($data['AGAMA']),
                        'nama_ibu' => $data['NAMA_IBU'],
                        'nama_ayah' => $data['NAMA_AYAH'],

                        'kategori_usia' => $this->getKategori($usia),
                        'status_pemilih' => $usia >= 17 ? 'Ya' : 'Tidak',
                        'status_validasi' => 'Valid',
                        'validated_by' => null,
                        'validated_at' => now(),
                    ]
                );

                $count++;
                if ($count >= 500) break;
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            fclose($handle);
            $this->command->error("Gagal import: " . $e->getMessage());
            return;
        }

        fclose($handle);

        $this->command->info("Selesai! Berhasil: $count data | Dilewati: $skipped");
    }

    private function getKategori($usia)
    {
        if ($usia <= 5) return "Balita";
        if ($usia <= 12) return "Anak-anak";
        if ($usia <= 16) return "Remaja";
        if ($usia <= 59) return "Dewasa";
        return "Lansia";
    }
}
