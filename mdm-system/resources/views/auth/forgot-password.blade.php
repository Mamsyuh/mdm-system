@extends('layouts.auth')
@section('title','Forgot password')

@section('content')
  <h1 class="text-2xl font-bold mb-2">Reset password</h1>
  <p class="text-sm text-gray-500 mb-6">Enter the email associated with your account. We'll send a reset link.</p>

  @if(session('status'))
    <div class="mb-4 p-3 bg-green-50 text-green-800 rounded">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
      @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg">Send reset link</button>
    </div>

    <p class="text-sm text-center text-gray-500">
      Return to <a href="{{ route('login') }}" class="text-purple-600 hover:underline">Sign in</a>
    </p>
  </form>
@endsection
