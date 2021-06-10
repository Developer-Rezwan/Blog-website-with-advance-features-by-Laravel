<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories']   = Category::with('user')
            ->select('user_id', 'id', 'name', 'slug', 'status')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('backend.category.index', $this->backend, $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create', $this->backend);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:categories,name'
        ]);
        $category = trim($request->name);
        $slug     = Str::slug($category);
        $status   = 0;
        if ($request->status == 'on') {
            $status = 1;
        }
        Category::create(['user_id' => auth()->user()->id, 'name' => $category, 'slug' => $slug, 'status' => $status]);
        session()->flash('message', 'Your Category is successfully Created!!!');
        return redirect()->route('category.index')->with('class', 'alert-success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $editCategory = Category::select('id', 'name', 'slug', 'status')->where('slug', $slug)->get();
        return view('backend.category.edit', compact('editCategory'), $this->backend);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = decrypt($request->data);
        $request->validate([
            'name'      => 'required|unique:categories,name,' . $id,
        ]);
        $status = 0;
        $status = $request->status == 'on' ? 1 : 0;

        $category = Category::findOrFail($id);
        $category->name     = $request->name;
        $category->slug     = Str::slug($request->name);
        $category->status   = $status;
        $category->save();

        session()->flash('message', 'Category is successfully Updated!!!');
        return redirect()->route('category.index')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Category::findOrFail($id)->delete();
        } catch (\Exception $e) {
            session()->flash('message', "Sorry! You Can't Delete This Category.Because of The Category contains some Sub-Category ! Firstly Delete All The Sub-Categories.");
            return redirect()->route('category.index')->with('class', 'alert-danger');
        }
        session()->flash('message', 'Category is successfully Deleted!!!');
        return redirect()->route('category.index')->with('class', 'alert-success');
    }
}