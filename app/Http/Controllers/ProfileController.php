<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the user profile page.
     */
    public function show()
    {
        $user = Auth::user();

        $roleTitles = [
            'admin' => 'Super Administrator',
            'tu' => 'Tenaga Administrasi Sekolah (TU)',
            'wali_kelas' => 'Wali Kelas Binaan',
            'teacher' => 'Tenaga Pendidik / Guru',
            'student' => 'Peserta Didik / Siswa',
            'panitia' => 'Panitia PPDB',
        ];

        $roleBadgeStyles = [
            'admin' => 'bg-purple-100 text-purple-700 border-purple-200',
            'tu' => 'bg-blue-100 text-blue-700 border-blue-200',
            'wali_kelas' => 'bg-teal-100 text-teal-700 border-teal-200',
            'teacher' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
            'student' => 'bg-amber-100 text-amber-700 border-amber-200',
            'panitia' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
        ];

        $userRoleKey = strtolower($user->role ?? 'admin');
        $userRoleLabel = $roleTitles[$userRoleKey] ?? ($user->role ?? 'Super Administrator');
        $userBadgeStyle = $roleBadgeStyles[$userRoleKey] ?? 'bg-slate-100 text-slate-700 border-slate-200';

        return view('spmb.profil', compact('user', 'userRoleLabel', 'userBadgeStyle'));
    }

    /**
     * Update user profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'bio' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama lengkap tidak boleh kosong.',
        ]);

        $user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'bio' => $validated['bio'] ?? null,
        ]);

        // Keep session synchronized
        session(['user' => [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'Administrator'
        ]]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini yang Anda masukkan tidak cocok.',
            ])->with('active_tab', 'security');
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return back()->with('success', 'Password berhasil diubah! Gunakan password baru saat login berikutnya.')
                     ->with('active_tab', 'security');
    }
}
