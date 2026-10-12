<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Peminjaman Mobil Dinas')</title>

  {{-- Favicon --}}
  <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
  <meta name="theme-color" content="#0d3151">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen">

  {{-- ============================================================
         SIDEBAR
         ============================================================ --}}
  <aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-brand-dark
              flex flex-col transition-transform duration-300 ease-out
              -translate-x-full lg:translate-x-0">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
      <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center
                        overflow-hidden shrink-0">
        <img src="{{ asset('logo.png') }}"
          alt="Logo"
          class="w-full h-full object-contain"
          onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\'font-size:1.5rem\'>🚗</span>'">
      </div>
      <div class="leading-tight">
        <p class="text-sm font-bold text-white">Peminjaman Mobil</p>
        <p class="text-[10px] text-blue-200/70">Lapas Perempuan IIA</p>
      </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto py-3">

      {{-- Utama --}}
      <p class="px-6 pt-2 pb-1 text-[10px] font-bold text-blue-200/40
                       uppercase tracking-widest">
        Utama
      </p>

      <a href="{{ route('dashboard') }}"
        class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
        </svg>
        <span>Dashboard</span>
      </a>

      {{-- Master Data --}}
      <p class="px-6 pt-4 pb-1 text-[10px] font-bold text-blue-200/40
                       uppercase tracking-widest">
        Master Data
      </p>

      <a href="{{ route('mobil.index') }}"
        class="nav-item {{ request()->routeIs('mobil.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
        </svg>
        <span>Daftar Mobil</span>
      </a>

      <a href="#"
        class="nav-item">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
        </svg>
        <span>Pengguna</span>
      </a>

      {{-- Transaksi --}}
      <p class="px-6 pt-4 pb-1 text-[10px] font-bold text-blue-200/40
                       uppercase tracking-widest">
        Transaksi
      </p>

      <a href="{{ route('peminjaman.index') }}"
        class="nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
          stroke-width="1.5" stroke="currentColor" class="w-5 h-5 shrink-0">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
        </svg>
        <span>Peminjaman</span>
      </a>
    </nav>

    {{-- User Box --}}
    <div class="border-t border-white/10 bg-black/20">
      <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-white/5 transition">
        <div class="w-9 h-9 rounded-full bg-brand-mid text-white flex items-center justify-center
                            font-bold text-sm border-2 border-white/20 shrink-0">
          {{ strtoupper(substr(session('user.name') ?? 'U', 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0 leading-tight">
          <p class="text-xs font-semibold text-white truncate">
            {{ session('user.name') ?? 'Guest' }}
          </p>
          <span class="inline-block mt-0.5 text-[10px] font-bold px-2 py-0.5 rounded-full
                                 bg-brand-blue text-white">
            {{ strtoupper(session('user.role') ?? 'USER') }}
          </span>
        </div>
      </a>

      <form method="POST" action="{{ route('logout') }}"
        class="border-t border-white/10">
        @csrf
        <button type="submit"
          class="w-full flex items-center justify-center gap-2 py-3
                               text-sm text-blue-100/70 hover:text-white hover:bg-red-500/20
                               transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
          </svg>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </aside>

  {{-- Overlay (mobile) --}}
  <div id="sidebarOverlay"
    class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-30
            hidden lg:hidden opacity-0 transition-opacity duration-300 ease-out"></div>

  {{-- ============================================================
         MAIN CONTENT
         ============================================================ --}}
  <div class="lg:ml-64 min-h-screen">

    {{-- Header --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-20
               backdrop-blur-md bg-white/90">
      <div class="flex items-center justify-between gap-3
                px-4 md:px-6 py-3
                max-w-full">

        {{-- Hamburger (mobile) --}}
        <button id="menuToggle"
          class="lg:hidden inline-flex items-center justify-center
                       w-9 h-9 sm:w-10 sm:h-10
                       rounded-lg bg-brand-dark text-white
                       hover:bg-brand-mid active:scale-95
                       transition-all duration-150">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>

        {{-- Page Title --}}
        <div class="flex-1 min-w-0">
          <h1 class="text-base sm:text-lg md:text-xl font-bold text-brand-dark truncate">
            @yield('page-title', 'Dashboard')
          </h1>
        </div>

        {{-- User info --}}
        <div class="flex items-center gap-2 shrink-0">
          <div class="w-8 h-8 rounded-full bg-brand-mid text-white
                        flex items-center justify-center
                        text-xs font-bold shrink-0">
            {{ strtoupper(substr(session('user.name') ?? 'U', 0, 1)) }}
          </div>
          <span class="hidden md:inline text-sm text-slate-600 font-medium truncate max-w-[140px]">
            {{ session('user.name') ?? 'Guest' }}
          </span>
        </div>

      </div>
    </header>

    {{-- Content --}}
    <main class="p-4 md:p-6 space-y-6">

      {{-- Flash message --}}
      @if (session('success'))
      <div class="px-4 py-3 rounded-lg bg-green-50 border border-green-200
                            text-green-700 text-sm flex items-start gap-2">
        <span>✓</span>
        <span>{{ session('success') }}</span>
      </div>
      @endif

      @if (session('error'))
      <div class="px-4 py-3 rounded-lg bg-red-50 border border-red-200
                            text-red-700 text-sm flex items-start gap-2">
        <span>⚠</span>
        <span>{{ session('error') }}</span>
      </div>
      @endif

      @yield('content')
    </main>

  </div>

</body>

</html>
