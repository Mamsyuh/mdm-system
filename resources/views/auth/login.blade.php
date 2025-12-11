<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Login Sistem') }}
        </h2>
    </x-slot>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md p-6 mx-auto bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-2xl border-t-4 border-blue-600">
        
        <!-- Logo Desa Benangin -->
        <div class="flex justify-center mb-6">
            <div class="relative">
                <!-- SVG Logo Desa -->
                <svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background Circle -->
                    <circle cx="60" cy="60" r="58" fill="#1e40af" opacity="0.1"/>
                    
                    <!-- Outer Ring -->
                    <circle cx="60" cy="60" r="55" fill="none" stroke="#2563eb" stroke-width="2"/>
                    
                    <!-- Inner Buildings/Village Icon -->
                    <g transform="translate(35, 35)">
                        <!-- Main Building (Balai Desa) -->
                        <rect x="15" y="15" width="20" height="25" fill="#2563eb" rx="1"/>
                        <rect x="18" y="18" width="4" height="4" fill="#93c5fd"/>
                        <rect x="27" y="18" width="4" height="4" fill="#93c5fd"/>
                        <rect x="18" y="25" width="4" height="4" fill="#93c5fd"/>
                        <rect x="27" y="25" width="4" height="4" fill="#93c5fd"/>
                        <polygon points="25,10 15,15 35,15" fill="#1e40af"/>
                        
                        <!-- Left Building -->
                        <rect x="5" y="22" width="12" height="18" fill="#3b82f6" rx="1"/>
                        <rect x="7" y="25" width="3" height="3" fill="#bfdbfe"/>
                        <rect x="12" y="25" width="3" height="3" fill="#bfdbfe"/>
                        <rect x="7" y="31" width="3" height="3" fill="#bfdbfe"/>
                        <polygon points="11,18 5,22 17,22" fill="#2563eb"/>
                        
                        <!-- Right Building -->
                        <rect x="33" y="22" width="12" height="18" fill="#3b82f6" rx="1"/>
                        <rect x="35" y="25" width="3" height="3" fill="#bfdbfe"/>
                        <rect x="40" y="25" width="3" height="3" fill="#bfdbfe"/>
                        <rect x="35" y="31" width="3" height="3" fill="#bfdbfe"/>
                        <polygon points="39,18 33,22 45,22" fill="#2563eb"/>
                        
                        <!-- Base Line -->
                        <rect x="0" y="40" width="50" height="2" fill="#1e40af"/>
                    </g>
                    
                    <!-- Data/Network Lines -->
                    <g opacity="0.3">
                        <line x1="25" y1="60" x2="15" y2="50" stroke="#2563eb" stroke-width="1.5"/>
                        <line x1="95" y1="60" x2="105" y2="50" stroke="#2563eb" stroke-width="1.5"/>
                        <line x1="60" y1="25" x2="50" y2="15" stroke="#2563eb" stroke-width="1.5"/>
                        <circle cx="15" cy="50" r="3" fill="#2563eb"/>
                        <circle cx="105" cy="50" r="3" fill="#2563eb"/>
                        <circle cx="50" cy="15" r="3" fill="#2563eb"/>
                    </g>
                    
                    <!-- Text Arc (Optional) -->
                    <path id="textPath" d="M 20,60 A 40,40 0 0,1 100,60" fill="none"/>
                    <text font-size="8" fill="#2563eb" font-weight="bold">
                        <textPath href="#textPath" startOffset="50%" text-anchor="middle">
                            DESA BENANGIN
                        </textPath>
                    </text>
                </svg>
                
                <!-- Animated Ring Effect -->
                <style>
                    @keyframes pulse-ring {
                        0% {
                            transform: scale(0.95);
                            opacity: 1;
                        }
                        50% {
                            transform: scale(1.05);
                            opacity: 0.7;
                        }
                        100% {
                            transform: scale(0.95);
                            opacity: 1;
                        }
                    }
                    .logo-container {
                        animation: pulse-ring 3s ease-in-out infinite;
                    }
                </style>
            </div>
        </div>

        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mb-1">
                Selamat Datang
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                Sistem Informasi Integrasi Dan Validasi Data Penduduk
            </p>
            <p class="text-gray-500 dark:text-gray-500 text-xs mt-1">
                Desa Benangin 1
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" 
                                placeholder="Masukkan Password Anda" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="w-full justify-center py-2 text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Masuk Sistem') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Footer Info -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                © Sistem Informasi Desa Benangin 1
            </p>
        </div>
    </div>
</x-guest-layout>