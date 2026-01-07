<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title', 'Auth') - Desa Benangin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(6px); }
    .fade-up { transform: translateY(8px); opacity: 0; transition: all .36s ease; }
    .fade-up.show { transform: translateY(0); opacity: 1; }
  </style>
  @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-700 via-indigo-700 to-pink-600 text-gray-900">
  <div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-3xl grid grid-cols-1 md:grid-cols-2 gap-8">
      {{-- left / visual --}}
      <div class="hidden md:flex flex-col justify-center px-8 py-12 rounded-2xl glass shadow-lg text-white">
        <h2 class="text-3xl font-bold mb-3">Welcome to Desa Benangin</h2>
        <p class="opacity-90 mb-6">Secure admin portal for village population records. Clean UI, fast workflow, and modern auth flows.</p>

        <ul class="space-y-3">
          <li class="flex items-center gap-3">
            <span class="inline-block w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">🔒</span>
            <span>Secure authentication</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="inline-block w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">⚡</span>
            <span>Fast form validations</span>
          </li>
          <li class="flex items-center gap-3">
            <span class="inline-block w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">📊</span>
            <span>Admin & operator ready</span>
          </li>
        </ul>

        <div class="mt-8 text-sm opacity-90">
          <p class="mb-1">Tips:</p>
          <ol class="list-decimal ml-5">
            <li>Use valid email for password reset</li>
            <li>Strong passwords help secure the system</li>
          </ol>
        </div>
      </div>

      {{-- right / form container --}}
      <div class="bg-white rounded-2xl p-6 md:p-10 shadow-xl">
        <div id="auth-card" class="fade-up show">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <script>
    // small animation hook (already shown via class)
    document.addEventListener('DOMContentLoaded', () => {
      const el = document.getElementById('auth-card');
      if (el) setTimeout(()=> el.classList.add('show'), 50);
    });
  </script>
  @stack('scripts')
</body>
</html>
