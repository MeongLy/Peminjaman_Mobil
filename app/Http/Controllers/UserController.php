<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna (support AJAX untuk realtime filter).
     */
    public function index(Request $request)
    {
        $query = User::query();

        // ---------- Search ----------
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        }

        // ---------- Filter Role ----------
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // ---------- Sorting ----------
        $sortable = [
            'name'  => 'name',
            'email' => 'email',
            'role'  => 'role',
        ];

        $sort      = $request->get('sort', 'name');
        $direction = strtolower($request->get('direction', 'asc')) === 'desc' ? 'desc' : 'asc';

        if (!array_key_exists($sort, $sortable)) {
            $sort = 'name';
        }

        $query->orderBy($sortable[$sort], $direction);

        $users = $query->paginate(10)->withQueryString();

        // ---------- Return JSON untuk AJAX ----------
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'html' => view('admin.users._table', [
                    'users'     => $users,
                    'sort'      => $sort,
                    'direction' => $direction,
                ])->render(),
            ]);
        }

        return view('admin.users.index', compact('users', 'sort', 'direction'));
    }

    /**
     * Simpan pengguna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,user',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
            'role.required'      => 'Role wajib dipilih.',
            'role.in'            => 'Role tidak valid.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna "' . $user->name . '" berhasil ditambahkan.');
    }

    /**
     * Update data pengguna (password opsional).
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|in:admin,user',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
            'role.required'      => 'Role wajib dipilih.',
            'role.in'            => 'Role tidak valid.',
        ]);

        // Password opsional — kalau kosong, jangan ubah
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Cegah admin mengubah role dirinya sendiri menjadi user
        // (biar tidak kehilangan akses admin)
        if ($user->id === session('user.id') && $validated['role'] !== 'admin') {
            return redirect()
                ->route('users.index')
                ->with('error', 'Anda tidak bisa mengubah role akun Anda sendiri.');
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna "' . $user->name . '" berhasil diperbarui.');
    }

    /**
     * Reset password pengguna (tanpa perlu password lama).
     */
    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Password "' . $user->name . '" berhasil direset.');
    }

    /**
     * Hapus pengguna.
     */
    public function destroy(User $user)
    {
        // Cegah hapus diri sendiri
        if ($user->id === session('user.id')) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        // Cegah hapus admin terakhir
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Tidak bisa menghapus admin terakhir.');
        }

        $nama = $user->name;
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna "' . $nama . '" berhasil dihapus.');
    }
}
