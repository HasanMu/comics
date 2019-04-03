<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $days = Day::all();
        $days = Day::paginate(7);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $days = Day::where("name", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('admin.day.index', compact('days'));
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
            'name' => 'required', 'string', 'max:20',
        ]);

        $days = new Day;

        $days->name = $request->name;
        $days->save();

        toastr()->success('Data '.$days->name.' berhasil ditambahkan!', 'Data berhasil ditambahkan!');

        return redirect()->route('days.index');
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
            'name' => 'required', 'string', 'max:20',
        ]);

        $days = Day::findOrFail($request->id);

        $days->name = $request->name;
        $days->save();

        toastr()->warning('Data '.$days->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->route('days.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $days = Day::findOrFail($request->id)->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('days.index');
    }
}
