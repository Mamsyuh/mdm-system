@extends('layouts.auth')
@section('title','Verify email')

@section('content')
  <h1 class="text-2xl font-bold mb-2">Verify your email</h1>
  <p class="text-sm text-gray-500 mb-6">Thanks for signing up! Before getting started, could you verify your email address by clicking the link we sent? If you didn't receive the email, we will gladly send you another.</p>

  @if(session('status') == 'verification-link-sent')
    <div class="mb-4 p-3 bg-green-50 text-green-800 rounded">A new verification link has been sent to your email address.</div>
  @endif

  <div class="space-y-3">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 rounded-lg">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="w-full text-sm text-gray-700 border rounded py-2">Log out</button>
    </form>
  </div>
@endsection
