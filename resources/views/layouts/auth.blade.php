<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Login') - SISKEP Benangin 1</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    /* Glassmorphism yang lebih soft untuk tema Navy */
    .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); }
    .fade-up { transform: translateY(15px); opacity: 0; transition: all .5s cubic-bezier(0.4, 0, 0.2, 1); }
    .fade-up.show { transform: translateY(0); opacity: 1; }
  </style>
  @stack('styles')
</head>
<body class="min-h-screen bg-[#0f172a] text-slate-900 overflow-x-hidden">
  
  {{-- Dekorasi Background (Glow Effect) --}}
  <div class="fixed top-0 left-0 w-full h-full pointer-events-none">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-600/10 rounded-full blur-[100px]"></div>
  </div>

  <div class="min-h-screen flex items-center justify-center px-4 py-10 relative z-10">
    <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-0 overflow-hidden shadow-2xl rounded-[2.5rem]">
      
      {{-- Left Side / Visual (Navy Theme) --}}
      <div class="hidden md:flex flex-col justify-center px-10 py-12 bg-slate-900/50 backdrop-blur-md text-white border-r border-white/5">
        <div class="mb-8">
            <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 mb-6">
                <span class="text-3xl">🏛️</span>
            </div>
            <h2 class="text-3xl font-black leading-tight uppercase tracking-tighter">SISKEP<br><span class="text-blue-400">BENANGIN 1</span></h2>
            <div class="w-12 h-1.5 bg-emerald-500 mt-4 rounded-full"></div>
        </div>

        <p class="text-slate-400 text-sm leading-relaxed mb-8">Portal administrasi terpadu untuk pengelolaan data kependudukan Desa Benangin 1 yang aman, cepat, dan modern.</p>

        <ul class="space-y-4">
          <li class="flex items-center gap-4 group">
            <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-emerald-400 border border-white/10 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                <i class="fas fa-shield-alt"></i>
            </span>
            <span class="text-sm font-medium text-slate-300">Autentikasi Keamanan Berlapis</span>
          </li>
          <li class="flex items-center gap-4 group">
            <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-blue-400 border border-white/10 group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                <i class="fas fa-bolt"></i>
            </span>
            <span class="text-sm font-medium text-slate-300">Validasi Data Real-time</span>
          </li>
          <li class="flex items-center gap-4 group">
            <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-purple-400 border border-white/10 group-hover:bg-purple-500 group-hover:text-white transition-all duration-300">
                <i class="fas fa-user-check"></i>
            </span>
            <span class="text-sm font-medium text-slate-300">Multi-role Admin & Operator</span>
          </li>
        </ul>

        <div class="mt-12 p-4 rounded-2xl bg-white/5 border border-white/5">
            <p class="text-[10px] uppercase tracking-[0.2em] font-bold text-slate-500 mb-2">Tips Keamanan:</p>
            <p class="text-xs text-slate-400 italic">"Gunakan kata sandi yang kuat dan jangan pernah bagikan akun login Anda kepada orang lain."</p>
        </div>
      </div>

      {{-- Right Side / Form Container --}}
      <div class="bg-white p-8 md:p-12 flex flex-col justify-center">
        <div id="auth-card" class="fade-up">
          <div class="md:hidden flex flex-col items-center mb-8">
             <span class="text-4xl mb-2">🏛️</span>
             <h2 class="text-xl font-black text-slate-900">SISKEP BENANGIN 1</h2>
          </div>
          
          @yield('content')
        </div>
      </div>
      
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const el = document.getElementById('auth-card');
      if (el) setTimeout(()=> el.classList.add('show'), 150);
    });
  </script>
  @stack('scripts')
</body>
</html>