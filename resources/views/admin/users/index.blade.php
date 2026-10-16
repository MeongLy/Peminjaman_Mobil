@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
            gap-3 mb-6 animate-fade-in-up">
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">
            Manajemen Pengguna
        </h2>
        <p class="text-sm text-slate-500 mt-0.5">
            Kelola akun pengguna dan hak akses sistem.
        </p>
    </div>
    <button type="button"
            id="btnTambahUser"
            class="inline-flex items-center justify-center gap-2
                   bg-brand-dark hover:bg-brand-mid text-white font-semibold
                   py-2.5 px-4 rounded-lg transition-colors duration-200
                   shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Pengguna</span>
    </button>
</div>

{{-- Toolbar --}}
<form method="GET"
      action="{{ route('users.index') }}"
      class="flex flex-col sm:flex-row gap-2 sm:gap-3 mb-4
             animate-fade-in-up delay-1"
      id="userFilterForm"
      data-ajax-url="{{ route('users.index') }}">

    {{-- Search --}}
    <div class="flex-1 flex items-center gap-2
                bg-white border border-slate-300 rounded-lg px-3 py-2
                focus-within:border-brand-blue focus-within:ring-2
                focus-within:ring-brand-blue/20 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <input type="text"
               name="q"
               id="searchUser"
               value="{{ request('q') }}"
               placeholder="Cari nama atau email..."
               autocomplete="off"
               class="flex-1 border-0 outline-none text-sm text-slate-800
                      placeholder:text-slate-400 bg-transparent">
    </div>

    {{-- Filter Role --}}
    <select name="role"
            id="filterRole"
            class="border border-slate-300 rounded-lg px-3 py-2 text-sm
                   text-slate-700 bg-white cursor-pointer outline-none
                   focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20
                   transition-all min-w-[140px]">
        <option value="">Semua Role</option>
        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="user"  {{ request('role') == 'user'  ? 'selected' : '' }}>User</option>
    </select>

    {{-- Reset Button --}}
    <button type="button"
            id="btnResetFilterUser"
            class="{{ request()->hasAny(['q', 'role']) ? '' : 'hidden' }}
                   inline-flex items-center justify-center gap-1.5
                   border border-slate-300 rounded-lg px-3 py-2
                   bg-white text-slate-600 hover:bg-red-50
                   hover:border-red-300 hover:text-red-600
                   transition-all text-sm font-medium
                   whitespace-nowrap">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
        </svg>
        <span class="hidden sm:inline">Reset</span>
    </button>
</form>

{{-- Tabel Container --}}
<div id="userTableContainer"
     class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
            animate-fade-in-up delay-2 transition-opacity duration-200">
    @include('admin.users._table')
</div>

{{-- Loading Overlay --}}
<div id="tableLoadingOverlay"
     class="fixed inset-0 bg-white/75 backdrop-blur-sm z-40
            hidden items-center justify-center gap-2
            text-brand-dark font-semibold text-sm"
     style="display: none;">
    <svg class="animate-spin h-5 w-5 text-brand-dark" xmlns="http://www.w3.org/2000/svg"
         fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    <span>Memuat...</span>
</div>

{{-- ============================================================
     MODAL: Tambah/Edit Pengguna
     ============================================================ --}}
<div id="modalUser"
     class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-50
            hidden items-center justify-center p-4"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg
                max-h-[90vh] flex flex-col overflow-hidden
                animate-fade-in-up">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h5 id="modalUserTitle" class="font-bold text-brand-dark text-base">
                Tambah Pengguna
            </h5>
            <button type="button"
                    class="w-8 h-8 rounded-lg flex items-center justify-center
                           text-slate-400 hover:bg-slate-100 hover:text-slate-700
                           transition-colors"
                    data-close-modal-user>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Form --}}
        <form id="formUser"
              method="POST"
              action="{{ route('users.store') }}"
              data-store-url="{{ route('users.store') }}"
              class="flex-1 overflow-y-auto p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethodUser" value="POST">

            {{-- Nama --}}
            <div>
                <label for="inputNamaUser" class="block text-xs font-bold text-slate-600
                                                  uppercase tracking-wide mb-2">
                    Nama Lengkap
                </label>
                <input type="text"
                       id="inputNamaUser"
                       name="name"
                       placeholder="Contoh: Ahmad Yani"
                       maxlength="100"
                       required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                              text-sm text-slate-800 placeholder:text-slate-400
                              focus:outline-none focus:ring-2 focus:ring-brand-blue
                              focus:border-transparent transition-all">
            </div>

            {{-- Email --}}
            <div>
                <label for="inputEmailUser" class="block text-xs font-bold text-slate-600
                                                   uppercase tracking-wide mb-2">
                    Email
                </label>
                <input type="email"
                       id="inputEmailUser"
                       name="email"
                       placeholder="user@lapas.id"
                       maxlength="100"
                       required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                              text-sm text-slate-800 placeholder:text-slate-400
                              focus:outline-none focus:ring-2 focus:ring-brand-blue
                              focus:border-transparent transition-all">
            </div>

            {{-- Password --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="inputPasswordUser" class="block text-xs font-bold text-slate-600
                                                          uppercase tracking-wide mb-2">
                        Password
                        <span id="passwordHint" class="text-[10px] text-slate-400
                                                       normal-case font-normal"></span>
                    </label>
                    <input type="password"
                           id="inputPasswordUser"
                           name="password"
                           placeholder="Minimal 6 karakter"
                           autocomplete="new-password"
                           class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                                  text-sm text-slate-800 placeholder:text-slate-400
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue
                                  focus:border-transparent transition-all">
                </div>
                <div>
                    <label for="inputPasswordConfirm" class="block text-xs font-bold text-slate-600
                                                             uppercase tracking-wide mb-2">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                           id="inputPasswordConfirm"
                           name="password_confirmation"
                           placeholder="Ulangi password"
                           autocomplete="new-password"
                           class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                                  text-sm text-slate-800 placeholder:text-slate-400
                                  focus:outline-none focus:ring-2 focus:ring-brand-blue
                                  focus:border-transparent transition-all">
                </div>
            </div>

            {{-- Role --}}
            <div>
                <label for="inputRoleUser" class="block text-xs font-bold text-slate-600
                                                  uppercase tracking-wide mb-2">
                    Role
                </label>
                <select id="inputRoleUser"
                        name="role"
                        required
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                               text-sm text-slate-800 bg-white cursor-pointer
                               focus:outline-none focus:ring-2 focus:ring-brand-blue
                               focus:border-transparent transition-all">
                    <option value="user">User — Pegawai biasa</option>
                    <option value="admin">Admin — Akses penuh</option>
                </select>
            </div>
        </form>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50
                    flex justify-end gap-2">
            <button type="button"
                    data-close-modal-user
                    class="px-4 py-2 text-sm font-medium text-slate-600
                           bg-white border border-slate-300 rounded-lg
                           hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <button type="submit"
                    form="formUser"
                    class="px-4 py-2 text-sm font-semibold text-white
                           bg-brand-dark hover:bg-brand-mid rounded-lg
                           transition-colors inline-flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                <span>Simpan</span>
            </button>
        </div>

    </div>
</div>

{{-- ============================================================
     MODAL: Reset Password
     ============================================================ --}}
<div id="modalResetPassword"
     class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-50
            hidden items-center justify-center p-4"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md
                max-h-[90vh] flex flex-col overflow-hidden animate-fade-in-up">

        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h5 class="font-bold text-brand-dark text-base">Reset Password</h5>
            <button type="button"
                    class="w-8 h-8 rounded-lg flex items-center justify-center
                           text-slate-400 hover:bg-slate-100 hover:text-slate-700
                           transition-colors"
                    data-close-modal-reset>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="formResetPassword" method="POST" action=""
              class="flex-1 overflow-y-auto p-6 space-y-4">
            @csrf

            <div class="px-3 py-2.5 rounded-lg bg-red-50 border border-red-100
                        text-sm text-red-700 flex items-start gap-2">
                <span class="text-lg leading-none">🔑</span>
                <div>
                    <p class="font-semibold">Reset password untuk:</p>
                    <p id="resetUserName" class="text-xs mt-0.5">-</p>
                </div>
            </div>

            <div>
                <label for="inputNewPassword" class="block text-xs font-bold text-slate-600
                                                     uppercase tracking-wide mb-2">
                    Password Baru
                </label>
                <input type="password"
                       id="inputNewPassword"
                       name="password"
                       placeholder="Minimal 6 karakter"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                              text-sm text-slate-800 placeholder:text-slate-400
                              focus:outline-none focus:ring-2 focus:ring-brand-blue
                              focus:border-transparent transition-all">
            </div>

            <div>
                <label for="inputNewPasswordConfirm" class="block text-xs font-bold text-slate-600
                                                            uppercase tracking-wide mb-2">
                    Konfirmasi Password
                </label>
                <input type="password"
                       id="inputNewPasswordConfirm"
                       name="password_confirmation"
                       placeholder="Ulangi password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg
                              text-sm text-slate-800 placeholder:text-slate-400
                              focus:outline-none focus:ring-2 focus:ring-brand-blue
                              focus:border-transparent transition-all">
            </div>
        </form>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50
                    flex justify-end gap-2">
            <button type="button"
                    data-close-modal-reset
                    class="px-4 py-2 text-sm font-medium text-slate-600
                           bg-white border border-slate-300 rounded-lg
                           hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <button type="submit"
                    form="formResetPassword"
                    class="px-4 py-2 text-sm font-semibold text-white
                           bg-brand-dark hover:bg-brand-mid rounded-lg
                           transition-colors inline-flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                </svg>
                <span>Reset Password</span>
            </button>
        </div>

    </div>
</div>

{{-- ============================================================
     MODAL: Konfirmasi Hapus
     ============================================================ --}}
<div id="modalHapus"
     class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-50
            hidden items-center justify-center p-4"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm
                overflow-hidden animate-fade-in-up">

        <div class="p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-50
                        flex items-center justify-center text-red-600 text-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>

            <h5 class="font-bold text-slate-800 text-lg mb-2">Hapus Pengguna?</h5>

            <p class="text-sm text-slate-500 leading-relaxed">
                Anda akan menghapus
                <strong id="confirmUserName" class="text-slate-800">pengguna ini</strong>.
                <br>
                <span class="text-xs">Tindakan ini tidak dapat dibatalkan.</span>
            </p>
        </div>

        <div class="px-6 pb-6 flex justify-center gap-2">
            <button type="button"
                    data-close-confirm
                    class="px-4 py-2 text-sm font-medium text-slate-600
                           bg-white border border-slate-300 rounded-lg
                           hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <form id="formHapus" method="POST" action="" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white
                               bg-red-600 hover:bg-red-700 rounded-lg
                               transition-colors inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Ya, Hapus</span>
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
