<?php

namespace App\Http\Controllers\Administrator\Management;

use App\Http\Controllers\Controller;
use App\Repositories\Administrator\Management\AdminManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminManagementController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminManagementRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getData()
    {
        $users = $this->adminRepository->getAllUsers();
        return view('administrator.cms.management.admin_management', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.unique' => 'Username ini sudah digunakan, silakan pilih username lain.',
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $payload = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password, // Otomatis di-hash oleh model User
            ];

            $this->adminRepository->store($payload);

            DB::commit();
            return redirect()->route('admin.management.getData')->with('success', 'Admin baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'username.unique' => 'Username ini sudah digunakan admin lain.',
            'email.unique' => 'Email ini sudah digunakan admin lain.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal terdiri dari 6 karakter.',
        ]);

        DB::beginTransaction();
        try {
            $payload = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $payload['password'] = $request->password;
            }

            $this->adminRepository->update($id, $payload);

            DB::commit();
            return redirect()->route('admin.management.getData')->with('success', 'Data admin berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun yang sedang Anda gunakan saat ini.');
        }

        if ($this->adminRepository->count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus admin terakhir pada sistem.');
        }

        DB::beginTransaction();
        try {
            $this->adminRepository->delete($id);

            DB::commit();
            return redirect()->route('admin.management.getData')->with('success', 'Akun admin berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

