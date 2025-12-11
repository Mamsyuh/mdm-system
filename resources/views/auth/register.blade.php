@extends('layouts.auth')

@section('title','Register')

@section('content')
  <h1 class="text-2xl font-bold mb-2">Create account</h1>
  <p class="text-sm text-gray-500 mb-6">Register as admin or operator (admin role assigned via DB).</p>

  <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-sm font-medium mb-1">Full name</label>
      <input name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-purple-300" required>
      @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
      @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Password</label>
      <div class="relative">
        <input id="reg-pass" type="password" name="password" class="w-full border rounded px-3 py-2 pr-10" required autocomplete="new-password">
        <button type="button" onclick="toggleInput('reg-pass', this)" class="absolute right-2 top-2 text-gray-500">Show</button>
      </div>
      <p id="pw-strength-text" class="text-xs mt-2 text-gray-500">Password strength: <span id="pw-strength" class="font-semibold">—</span></p>
      <div class="w-full bg-gray-200 h-1 rounded mt-2 overflow-hidden">
        <div id="pw-bar" class="h-1 bg-red-500 w-0 transition-all"></div>
      </div>
      @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Confirm password</label>
      <input id="reg-pass-confirm" type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg font-semibold">Create account</button>
    </div>

    <p class="text-center text-sm text-gray-500">
      Already have an account? <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Sign in</a>
    </p>
  </form>
@endsection

@push('scripts')
<script>
  // Password strength simple meter
  const pass = document.getElementById('reg-pass');
  const bar = document.getElementById('pw-bar');
  const text = document.getElementById('pw-strength');

  function strengthScore(s){
    let score = 0;
    if(!s) return 0;
    if(s.length >= 8) score++;
    if(/[0-9]/.test(s)) score++;
    if(/[A-Z]/.test(s)) score++;
    if(/[^A-Za-z0-9]/.test(s)) score++;
    return score;
  }

  pass && pass.addEventListener('input', (e)=>{
    const v = e.target.value;
    const s = strengthScore(v);
    const pct = (s/4)*100;
    bar.style.width = pct+'%';
    if(s <= 1){ bar.className = 'h-1 bg-red-500 w-['+pct+'%] transition-all'; text.innerText = 'Weak'; text.style.color = '#ef4444'; }
    else if(s === 2){ bar.className = 'h-1 bg-yellow-400 w-['+pct+'%] transition-all'; text.innerText = 'Fair'; text.style.color = '#f59e0b'; }
    else if(s === 3){ bar.className = 'h-1 bg-indigo-500 w-['+pct+'%] transition-all'; text.innerText = 'Good'; text.style.color = '#6366f1'; }
    else { bar.className = 'h-1 bg-green-500 w-['+pct+'%] transition-all'; text.innerText = 'Strong'; text.style.color = '#10b981'; }
  });

  function toggleInput(id, btn){
    const el = document.getElementById(id);
    if(!el) return;
    if(el.type === 'password'){ el.type = 'text'; btn.innerText = 'Hide'; } else { el.type = 'password'; btn.innerText = 'Show'; }
  }
</script>
@endpush
