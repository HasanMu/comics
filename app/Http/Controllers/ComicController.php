<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comic;
use App\Genre;
use App\User;
use App\Category;
use App\Day;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comics = Comic::with('users', 'genres', 'episodes')->get();
        $comics = Comic::paginate(5);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $comics = Comic::where("name", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('admin.comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        $category = Category::all();
        $users = User::all();
        $days = Day::all();

        return view('admin.comics.create', compact('genres', 'category', 'users', 'days'));
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
            'name' => 'required|max:30|string',
            'description' => 'required|max:500|string',
            'users' => 'required',
            'genres' => 'required',
            'category' => 'required',
            'days' => 'required',
            'hours' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg',
            'cover' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $comics = new Comic;

        $comics->name = $request->name;
        $comics->slug = str_slug($request->name);
        $comics->description = $request->description;
        $comics->category_id = $request->category;
        $comics->hours = $request->hours;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $destinationPatch = public_path().'/admin/assets/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            $comics->thumbnail = $filename;
        }

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $destinationPatch = public_path().'/admin/assets/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            $comics->cover = $filename;
        }

        $comics->save();

        $comics->users()->attach($request->users);
        $comics->genres()->attach($request->genres);
        $comics->days()->attach($request->days);

        toastr()->success('Data '.$comics->name.' berhasil ditambahkan!', 'Data berhasil ditambah!');
        return redirect()->route('comics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comic = Comic::findOrFail($id);

        $author = User::all();
        $genres = Genre::all();
        $category = Category::all();
        $days = Day::all();

        $selectAuthor = $comic->users->pluck('id')->toArray();
        $selectGenre = $comic->genres->pluck('id')->toArray();
        $selectDay = $comic->days->pluck('id')->toArray();

        return view('admin.comics.edit', compact('comic', 'author', 'genres', 'category', 'days', 'selectAuthor', 'selectGenre','selectDay'));
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
            'name' => 'required|max:30|string',
            'description' => 'required|max:500|string',
            'users' => 'required',
            'genres' => 'required',
            'category' => 'required',
            'days' => 'required',
            'hours' => 'required',
        ]);

        $comics = Comic::findOrFail($id);

        $comics->name = $request->name;
        $comics->slug = str_slug($request->name);
        $comics->description = $request->description;
        $comics->category_id = $request->category;
        $comics->hours = $request->hours;
        $comics->status = $request->status;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $destinationPatch = public_path().'/admin/assets/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);

            if ($comics->thumbnail) {
                $old_gambar = $comics->thumbnail;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/assets/avatars/'.DIRECTORY_SEPARATOR.$comics->thumbnail;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $comics->thumbnail = $filename;
        }

        if ($request->thumbnail == '') {
            $comics->thumbnail = $request->thmb;
        }

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $destinationPatch = public_path().'/admin/assets/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            if ($comics->cover) {
                $old_gambar = $comics->cover;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/assets/avatars/'.DIRECTORY_SEPARATOR.$comics->cover;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $comics->cover = $filename;
        }

        if ($request->cover == '') {
            $comics->cover = $request->cvr;
        }

        $comics->save();

        $comics->users()->sync($request->users);
        $comics->genres()->sync($request->genres);
        $comics->days()->sync($request->days);

        toastr()->warning('Data '.$comics->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->route('comics.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comic = Comic::findOrFail($request->id);

        $comic->users()->detach($comic);
        $comic->genres()->detach($comic);
        $comic->days()->detach($comic);
        $comic->episodes()->detach($comic);

        $comic->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('comics.index');
    }
}
