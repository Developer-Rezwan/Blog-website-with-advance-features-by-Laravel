<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['subCategories'] = Sub_category::with('category')->select('id', 'category_id', 'name', 'slug', 'status')->orderBy('updated_at', 'desc')->get();
        return view('backend.sub-category.index', $this->backend, $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['subCategories'] = Sub_category::with('category')
            ->select('name', 'category_id', 'status')
            ->get();

        $this->data['categories']    = Category::select('id', 'name')
            ->where('status', 1)
            ->get();
        return view('backend.sub-category.create', $this->backend, $this->data);
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
            'name'          => 'required|unique:sub_categories,name',
            'category_Id'   => 'required|integer'
        ]);
        $category_id = $request->category_Id;
        $subCategory = trim($request->name);
        $slug     = Str::slug($subCategory);
        $status   = 0;
        if ($request->status == 'on') {
            $status = 1;
        }
        Sub_category::create(['name' => $subCategory, 'category_id' => $category_id, 'slug' => $slug, 'status' => $status]);
        session()->flash('message', 'Sub-Category Successfully Created!!!');
        return redirect()->route('sub-category.index')->with('class', 'alert-success');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $this->data['categories']     = Category::select('name', 'id')->get();
        $this->data['subCategory']    = Sub_category::with('category')->select('id', 'name', 'slug', 'category_id', 'status')->where('slug', $slug)->get()[0];
        return view('backend.sub-category.edit', $this->data, $this->backend);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $id = decrypt($request->data);
        $request->validate([
            'name'          => 'required|unique:sub_categories,name,' . $id,
            'category_Id'   => 'required|integer'
        ]);
        $category_id = $request->category_Id;
        $name = trim($request->name);
        $slug     = Str::slug($name);
        $status   = 0;
        if ($request->status == 'on') {
            $status = 1;
        }
        $subCategory = Sub_category::findOrFail($id);
        $subCategory->name          = $name;
        $subCategory->slug          = $slug;
        $subCategory->category_id   = $category_id;
        $subCategory->status        = $status;
        $subCategory->save();

        session()->flash('message', 'Sub-Category Successfully Updated!!!');
        return redirect()->route('sub-category.index')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sub_category::findOrFail($id)->delete();
        session()->flash('message', 'Sub-Category Successfully Deleted!!!');
        return redirect()->route('sub-category.index')->with('class', 'alert-danger');
    }
}