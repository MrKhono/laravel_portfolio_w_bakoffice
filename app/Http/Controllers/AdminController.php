<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function profile(){

        $id = Auth::user()->id;

        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function storeProfile(Request $request){

        $id = Auth::user()->id;

        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        
        if($request->file('profile_image')){
            $file = $request->file('profile_image');

            $fileName = date('ymdHi').$file->getClientOriginalName();

            $file->move(public_path('upload/admin_images'),$fileName);

            $data['profile_image'] = $fileName;
        }

        $data->save();


        return redirect()->route('admin.profile')->with('success', 'Admin profile updated succesfullly ✅');
    }
}
