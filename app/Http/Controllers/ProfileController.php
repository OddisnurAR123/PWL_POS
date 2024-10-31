<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        // Set active menu and breadcrumb
        $activeMenu = 'profile';
        $breadcrumb = (object) [
            'title' => 'Edit Profile',
            'list' => ['Home', 'Edit Profile']
        ];
        $page = (object) [
            'title' => 'Upload Foto'
        ];
    
        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Fetch user profile and levels
        $profile = $user->profile; // Ensure that you have a relationship set up for this
        $levels = LevelModel::all(); // Fetch all levels
    
        // Return the view with the necessary data
        return view('profile.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'profile' => $profile,
            'levels' => $levels,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Jika ada avatar lama, hapus dari storage
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        if ($request->file('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);
            /** @var \App\Models\User $user **/
            $user->avatar = $avatarName;
            $user->save();
        } // Upload avatar baru

        return redirect('/profile')->with('success', 'Foto Profil Berhasil Diperbarui!');
    }

    public function updateDataDiri(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'username' => 'required|string|min:3',
            'nama' => 'required|string|max:100',
        ]);

        // Update informasi pengguna
        $user->username = $request->username;
        $user->nama = $request->nama;
        /** @var \App\Models\User $user **/
        $user->save();

        return redirect('/profile')->with('success', 'Data Diri Berhasil Diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Cek apakah password lama sesuai dengan password user yang sedang login
        $currentPassword = Auth::user()->password;
        if (!Hash::check($request->old_password, $currentPassword)) {
            return redirect()->back()->withErrors(['old_password' => 'Password lama tidak sesuai']);
        }

        /** @var \App\Models\User $user */
        // Update password baru
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}