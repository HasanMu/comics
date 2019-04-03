<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;
use App\Comic;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $episodes = Episode::with('comics')->get();
        $eps = Episode::all()->count();
        $episodes = Episode::paginate(5);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $episodes = Episode::where("name", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('admin.episode.index', compact('episodes', 'eps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comics = Comic::all();
        $eps = Episode::all()->count();

        return view('admin.episode.create', compact('comics', 'eps'));
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
            'name' => 'required|string|max:25',
            'avatar' => 'required|image|mimes:jpg,png,jpeg',
            'file' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $episode = new Episode;

        $episode->name = $request->name;
        $episode->slug = str_slug($request->name);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPatch = public_path().'/admin/assets/episodes/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            $episode->avatar = $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPatch = public_path().'/admin/assets/episodes/file/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);
            $episode->file = $filename;
        }

        $episode->save();
        $episode->comics()->attach($request->comics);

        toastr()->success('Data '.$episode->name.' berhasil ditambahkan!', 'Data berhasil ditambahkan!');

        return redirect()->route('episodes.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $episode = Episode::findOrFail($id);
        $eps = Episode::with('id', $id)->count();
        $comics = Comic::all();

        $selectComic = $episode->comics->pluck('id')->toArray();

        return view('admin.episode.edit', compact('episode', 'eps', 'comics', 'selectComic'));
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
            'name' => 'required|string|max:25',
            'avatar' => 'image|mimes:jpg,png,jpeg',
            'file' => 'image|mimes:jpg,png,jpeg'
        ]);

        $episode = Episode::findOrFail($id);

        $episode->name = $request->name;
        $episode->slug = str_slug($request->name);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destinationPatch = public_path().'/admin/assets/episodes/avatars/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);

            if ($episode->avatar) {
                $old_gambar = $episode->avatar;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/assets/episodes/avatars/'.DIRECTORY_SEPARATOR.$episode->avatar;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $episode->avatar = $filename;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPatch = public_path().'/admin/assets/episodes/file/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destinationPatch, $filename);

            if ($episode->file) {
                $old_gambar = $episode->file;
                $filepath = public_path().DIRECTORY_SEPARATOR.'/admin/assets/episodes/file/'.DIRECTORY_SEPARATOR.$episode->file;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    //File sudah dihapus / tidak ada!
                }
            }
            $episode->file = $filename;
        }

        $episode->save();
        $episode->comics()->sync($request->comics);

        toastr()->warning('Data '.$episode->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->route('episodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $episode = Episode::findOrFail($request->id);
        $episode->comics()->detach($episode->id);

        $episode->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('episodes.index');

    }

    public function preview($id)
    {
        $episode = Episode::findOrFail($id);

        return view('admin.episode.preview', compact('episode'));
    }
}
