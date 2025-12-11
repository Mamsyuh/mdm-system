@extends('layouts.auth')
@section('title','Confirm password')

@section('content')
  <h1 class="text-2xl font-bold mb-2">Confirm password</h1>
  <p class="text-sm text-gray-500 mb-6">For your security, please confirm your password before continuing.</p>

  <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm mb-1">Password</label>
      <input type="password" name="password" class="w-full border rounded px-3 py-2" required autofocus>
      @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg">Confirm</button>
    </div>

    <p class="text-sm text-center text-gray-500">
      <a href="{{ route('password.request') }}" class="text-purple-600 hover:underline">Forgot your password?</a>
    </p>
  </form>
@endsection
