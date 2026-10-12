<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Peminjaman Mobil Dinas</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">
    <meta name="theme-color" content="#0d3151">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center p-6
             bg-gradient-to-br from-brand-dark via-brand-mid to-brand-blue">

    <div class="w-full max-w-md">

        {{-- Card Login --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl
                    p-8 md:p-10 text-center">

            {{-- Header --}}
            <h1 class="text-xl md:text-2xl font-bold text-brand-dark leading-tight mb-2">
                Peminjaman Mobil Dinas
            </h1>
            <h2 class="text-sm md:text-base font-semibold text-slate-500 leading-snug mb-6">
                Lapas Perempuan Kelas IIA<br>Palangka Raya
            </h2>

            {{-- Logo --}}
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl overflow-hidden
                        bg-slate-100 flex items-center justify-center
                        shadow-lg shadow-brand-dark/20">
                <img src="{{ asset('logo.jpg') }}"
                     alt="Logo"
                     class="w-full h-full object-contain"
                     onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-size:2.5rem\'>🚗</span>'">
            </div>

            {{-- Alerts --}}
            @if ($errors->any())
                <div class="px-4 py-3 rounded-lg mb-4 text-sm flex items-start gap-2 text-left
                            bg-red-50 border border-red-200 text-red-700">
                    <span>⚠</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="px-4 py-3 rounded-lg mb-4 text-sm flex items-start gap-2 text-left
                            bg-green-50 border border-green-200 text-green-700">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form id="loginForm"
                  method="POST"
                  action="{{ route('login.post') }}"
                  class="text-left space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email"
                           class="block text-xs font-bold text-slate-600
                                  uppercase tracking-wide mb-2">
                        Email Address
                    </label>
                    <div class="flex items-stretch border border-slate-300 rounded-lg
                                overflow-hidden bg-white transition-all duration-150
                                focus-within:border-brand-blue focus-within:ring-2
                                focus-within:ring-brand-blue/20">

                        {{-- Icon Mail --}}
                        <span class="flex items-center px-3 text-slate-400 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@lapas.id"
                            class="flex-1 border-0 outline-none py-2.5 pr-3 text-sm
                                   text-slate-800 placeholder:text-slate-400 bg-transparent"
                            required
                            autofocus
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password"
                           class="block text-xs font-bold text-slate-600
                                  uppercase tracking-wide mb-2">
                        Kata Sandi
                    </label>
                    <div class="flex items-stretch border border-slate-300 rounded-lg
                                overflow-hidden bg-white transition-all duration-150
                                focus-within:border-brand-blue focus-within:ring-2
                                focus-within:ring-brand-blue/20">

                        {{-- Icon Lock --}}
                        <span class="flex items-center px-3 text-slate-400 bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            class="flex-1 border-0 outline-none py-2.5 pr-3 text-sm
                                   text-slate-800 placeholder:text-slate-400 bg-transparent"
                            required
                        >

                        {{-- Toggle Eye --}}
                        <button type="button"
                                id="togglePassword"
                                class="flex items-center px-3 text-slate-400
                                       hover:text-brand-dark bg-white
                                       transition-colors duration-150"
                                aria-label="Toggle password"
                                tabindex="-1">
                            <svg id="eyeIcon"
                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        id="submitBtn"
                        class="w-full inline-flex items-center justify-center gap-2
                               bg-brand-dark hover:bg-brand-mid text-white font-semibold
                               py-3 px-4 rounded-full transition-colors duration-200
                               focus:outline-none focus:ring-2 focus:ring-brand-dark
                               focus:ring-offset-2 disabled:opacity-60 disabled:cursor-not-allowed">
                    <span>Masuk</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-6 pt-6 border-t border-slate-100">
                <p class="text-xs text-slate-400">
                    Sistem Peminjaman Mobil Dinas
                </p>
            </div>

        </div>

    </div>

</body>
</html>
