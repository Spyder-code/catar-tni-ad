<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        abort_unless((int) $id === Auth::id(), 403);
        Auth::user()->update($request->only(['name', 'username']));
        return back()->with('success', 'Profil berhasil diupdate');
    }

    public function updatePassword(Request $request,$id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required'],
        ]);

        abort_unless((int) $id === Auth::id(), 403);
        if(Hash::check($request->current_password, Auth::user()->password)){
            Auth::user()->update(['password'=>Hash::make($request->password)]);
            return back()->with('success','Password berhasil diubah');
        }else{
            return back()->with('danger','Password lama salah');;
        }
    }

    public function updateImage(Request $request, $id)
    {
        abort_unless((int) $id === Auth::id(), 403);
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($files = $request->file('avatar')) {
            $profileImage = Auth::id().'.jpg';
            $path = $files->storeAs('public/user', $profileImage);
            $url = Storage::url($path);
            $imgUrl = url($url);
            Auth::user()->update(['avatar'=>$imgUrl]);
            return back()->with('success','Avatar berhasil diubah');
        }
    }

}
