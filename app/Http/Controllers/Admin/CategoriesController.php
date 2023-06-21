<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Support\Str;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\Session\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('name', 'asc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('name', 'asc')->get();
        // $categories = $categories->toArray();
        return view('admin.categories.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['parent_id'] = (int)$params['parent_id'];

        if (Categories::create($params)){
            $request->session()->flash('success', 'Category has been saved');
        }
        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    // public function show(Categories $categories)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $categories = Categories::orderBy('name', 'asc')->get();

        return view('admin.categories.form', compact('category', 'categories'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    // public function update(CategoryRequest $request, $id)
    // {
    //     $params = $request->except('_token');
    //     $params['slug'] = Str::slug($params['name']);

    //     $category = Categories::findOrFail($id);
    //     if($category->update($params)){
    //         $request->session()->flash('success', 'Category has been updated');
    //     }

    //     return redirect('admin/categories');
    // }

    public function update(CategoryRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $category = Categories::findOrFail($id);

        // Periksa apakah parent_id sama dengan parent_id yang ada di database
        if ($params['parent_id'] != $category->parent_id && $params['parent_id'] == $id) {
            return redirect()->back()->withInput()->withErrors('Parent category must be different');
        }

        if ($category->update($params)) {
            $request->session()->flash('success', 'Category has been updated');
        }

        return redirect('admin/categories');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::findOrFail($id)->delete();
        return back()->with('success','Category has been deleted');
    }
}
