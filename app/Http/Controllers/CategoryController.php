<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::all();
        $category = Category::paginate(5);

        $filterKeyword = $request->get('q');

        if($filterKeyword){
            $category = Category::where("name", "LIKE", "%$filterKeyword%")->paginate(8);
        }

        return view('admin.category.index', compact('category'));
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

        $category = new Category;

        $category->name = $request->name;
        $category->save();

        toastr()->success('Data '.$category->name.' berhasil ditambahkan!', 'Data berhasil ditambahkan!');

        return redirect()->route('categories.index');
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

        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->save();

        toastr()->warning('Data '.$category->name.' berhasil diperbarui!', 'Data berhasil diedit!');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id)->delete();

        toastr()->error('Data berhasil  dihapus!', 'Data berhasil dihapus!');

        return redirect()->route('categories.index');
    }
}
