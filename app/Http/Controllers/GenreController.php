<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genres = Genre::all();
        $genres = Genre::paginate(5);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $genres = Genre::where("name", "LIKE", "%$filterKeyword%")->paginate(5);
        }

        return view('admin.genre.index', compact('genres'));
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
            'name' => 'required', 'max:20', 'string',
        ]);

        $genre = new Genre;

        $genre->name = $request->name;
        $genre->save();

        toastr()->success('Data has been saved successfully!');

        return redirect()->route('genres.index');
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
            'name' => 'required', 'max:20', 'string',
        ]);

        $genre = Genre::findOrFail($request->id);

        $genre->name = $request->name;
        $genre->save();

        toastr()->warning('Data '.$genre->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->route('genres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $genre = Genre::findOrFail($request->id)->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('genres.index');
    }
}
