<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use File;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function profile($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.profile.index', compact('admin'));
    }

    public function profile_update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPatch = public_path().'/admin/profile/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);

            if ($admin->avatar) {
                $old_gambar = $admin->avatar;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/profile/'.DIRECTORY_SEPARATOR.$admin->avatar;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $admin->avatar = $filename;
        }

        $admin->save();

        toastr()->warning('Data '.$admin->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->back();
    }
}
