{{-- Table (Desktop) --}}
<div class="hidden md:block overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-[10px] font-bold text-slate-500
                       uppercase tracking-wider border-b border-slate-100">
                <th class="px-6 py-3 w-16">No</th>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3 w-32">Role</th>
                <th class="px-6 py-3 w-24 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($users as $i => $user)
                <tr class="hover:bg-slate-50/70 transition-colors
                           animate-fade-in">
                    <td class="px-6 py-4 text-slate-500 text-sm">
                        {{ $users->firstItem() + $i }}
                    </td>

                    {{-- Nama --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-brand-mid text-white
                                        flex items-center justify-center
                                        font-bold text-sm shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800 truncate">
                                    {{ $user->name }}
                                </p>
                                @if ($user->id === session('user.id'))
                                    <span class="text-[10px] font-semibold text-brand-blue">
                                        ● Anda
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $user->email }}
                    </td>

                    {{-- Role --}}
                    <td class="px-6 py-4">
                        @if ($user->role === 'admin')
                            <span class="inline-flex items-center gap-1.5
                                         bg-indigo-50 text-indigo-700
                                         px-2.5 py-1 rounded-full text-xs font-semibold">
                                🛡 Admin
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5
                                         bg-cyan-50 text-cyan-700
                                         px-2.5 py-1 rounded-full text-xs font-semibold">
                                👤 User
                            </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4 text-right">
                        <div class="relative inline-block" data-dropdown>
                            <button type="button"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center
                                           text-slate-500 hover:bg-slate-100 hover:text-brand-dark
                                           transition-colors"
                                    data-dropdown-toggle>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg>
                            </button>

                            <div class="absolute right-0 top-full mt-1 min-w-[180px]
                                        bg-white border border-slate-200 rounded-lg
                                        shadow-lg p-1.5 z-30 hidden text-left"
                                 data-dropdown-menu>
                                <button type="button"
                                        class="w-full flex items-center gap-2.5 px-3 py-2
                                               text-sm text-slate-700 hover:bg-slate-100
                                               rounded-md transition-colors"
                                        data-user='@json($user)'
                                        data-edit-toggle-user>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span>Edit</span>
                                </button>

                                <button type="button"
                                        class="w-full flex items-center gap-2.5 px-3 py-2
                                               text-sm text-slate-700 hover:bg-slate-100
                                               rounded-md transition-colors"
                                        data-reset-toggle
                                        data-reset-id="{{ $user->id }}"
                                        data-reset-nama="{{ $user->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                    <span>Reset Password</span>
                                </button>

                                <div class="h-px bg-slate-100 my-1"></div>

                                @if ($user->id !== session('user.id'))
                                    <button type="button"
                                            class="w-full flex items-center gap-2.5 px-3 py-2
                                                   text-sm text-red-600 hover:bg-red-50
                                                   rounded-md transition-colors"
                                            data-hapus-url="{{ route('users.destroy', $user->id) }}"
                                            data-hapus-nama="{{ $user->name }}"
                                            data-hapus-toggle>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                @else
                                    <div class="px-3 py-2 text-xs text-slate-400 italic">
                                        Akun Anda sendiri
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-2 text-slate-400">
                            <span class="text-4xl">👥</span>
                            <p class="text-sm">Belum ada data pengguna</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Card List (Mobile) --}}
<div class="md:hidden divide-y divide-slate-100">
    @forelse ($users as $user)
        <div class="p-4 animate-fade-in">

            <div class="flex items-center gap-3 mb-3">
                <div class="w-11 h-11 rounded-full bg-brand-mid text-white
                            flex items-center justify-center font-bold shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="font-semibold text-slate-800 text-sm truncate">
                        {{ $user->name }}
                    </p>
                    <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                </div>

                @if ($user->role === 'admin')
                    <span class="shrink-0 bg-indigo-50 text-indigo-700
                                 px-2 py-0.5 rounded-full text-[10px] font-bold">
                        🛡 Admin
                    </span>
                @else
                    <span class="shrink-0 bg-cyan-50 text-cyan-700
                                 px-2 py-0.5 rounded-full text-[10px] font-bold">
                        👤 User
                    </span>
                @endif
            </div>

            <div class="flex gap-2 justify-end">
                <button type="button"
                        class="text-xs font-semibold text-slate-600
                               bg-slate-100 hover:bg-slate-200
                               px-3 py-1.5 rounded-lg transition-colors"
                        data-user='@json($user)'
                        data-edit-toggle-user>
                    Edit
                </button>

                <button type="button"
                        class="text-xs font-semibold text-brand-blue
                               bg-blue-50 hover:bg-blue-100
                               px-3 py-1.5 rounded-lg transition-colors"
                        data-reset-toggle
                        data-reset-id="{{ $user->id }}"
                        data-reset-nama="{{ $user->name }}">
                    Reset
                </button>

                @if ($user->id !== session('user.id'))
                    <button type="button"
                            class="text-xs font-semibold text-red-600
                                   bg-red-50 hover:bg-red-100
                                   px-3 py-1.5 rounded-lg transition-colors"
                            data-hapus-url="{{ route('users.destroy', $user->id) }}"
                            data-hapus-nama="{{ $user->name }}"
                            data-hapus-toggle>
                        Hapus
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="p-12 text-center">
            <div class="flex flex-col items-center gap-2 text-slate-400">
                <span class="text-4xl">👥</span>
                <p class="text-sm">Belum ada data pengguna</p>
            </div>
        </div>
    @endforelse
</div>

{{-- Footer --}}
<div class="px-4 sm:px-6 py-3 border-t border-slate-100 bg-slate-50/50
            flex flex-col sm:flex-row items-center justify-between gap-2">
    <p class="text-[10px] sm:text-xs text-slate-500">
        Menampilkan
        <strong>{{ $users->firstItem() ?? 0 }}</strong> –
        <strong>{{ $users->lastItem() ?? 0 }}</strong>
        dari <strong>{{ $users->total() }}</strong> pengguna
    </p>
    <div>
        {{ $users->links() }}
    </div>
</div>
