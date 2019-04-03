<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use FileNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $users = User::paginate(8);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $users = User::where("name", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'address' => 'required', 'string', 'max:500',
            'age' => 'required', 'integer',
            'gender' => 'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ]);

        $users = new User;

        $users->name = $request->name;
        $users->email = $request->email;
        $users->address = $request->address;
        $users->age = $request->age;
        $users->gender = $request->gender;
        $users->password = bcrypt($request->password);
        if (!$request->bio == '') {
            $users->bio = $request->bio;
        }

        $users->avatar = "avatar-1.png";

        $users->save();
        toastr()->success('Data '.$users->name.' berhasil  ditambahkan!', 'Data berhasil ditambah!');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $genders = User::all();

        return view('admin.users.show', compact('user', 'genders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'address' => 'required', 'string', 'max:500',
            'age' => 'required', 'integer',
            'gender' => 'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->bio = $request->bio;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPatch = public_path().'/admin/assets/avatar/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);

            if ($user->avatar) {
                $old_gambar = $user->avatar;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/assets/avatars/'.DIRECTORY_SEPARATOR.$user->avatar;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $user->avatar = $filename;
        }

        $user->save();
        toastr()->warning('Data '.$user->name.' berhasil di edit !', 'Data berhasil Edit!');

        return redirect()->route('users.index');
    }

    /**
     * Update Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function updatePassword(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'password' => 'required', 'string', 'min:6', 'confirmed',
    //         'new_password' => 'required', 'string', 'min:6', 'same:password',
    //     ]);

    //     $user = User::findOrFail($id);

    //     $user->password = $request->password;

    //     $user->save();

    //     return redirect()->route('users.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->comics()->detach($user);

        $user->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('users.index');
    }
}
