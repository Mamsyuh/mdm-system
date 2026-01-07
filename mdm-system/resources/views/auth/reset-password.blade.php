@extends('layouts.auth')

@section('title','Reset password')

@section('content')
  <h1 class="text-2xl font-bold mb-2">Set a new password</h1>
  <p class="text-sm text-gray-500 mb-6">Create a new secure password for your account.</p>

  <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">

    <div>
      <label class="block text-sm mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email', request('email')) }}" class="w-full border rounded px-3 py-2" required>
      @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm mb-1">New password</label>
      <input id="reset-pass" type="password" name="password" class="w-full border rounded px-3 py-2" required>
      @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm mb-1">Confirm password</label>
      <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg">Reset password</button>
    </div>
  </form>
@endsection
