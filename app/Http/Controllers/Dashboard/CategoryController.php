<?php

namespace App\Http\Controllers\Dashboard;

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
        $categories = Category::latest('id')->withCount('Product')->get();
        return view('backend.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => ['required', 'unique:categories,title'],
        ]);


        $category = new Category;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->save();

        return response()->json([
            'success' => 'Category Added'
        ]);
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
        $data = Category::findorfail($id);
        $html = view('backend.modal.edit-category-modal', compact('data'))->render();
        return response()->json([
            'html' => $html,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,)
    {
        $request->validate([
            'id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'unique:categories,title,'.$request->id],
        ]);
           $category = Category::findorfail($request->id);
           $category->title = $request->title;
           $category->slug = Str::slug($request->title);
           $category->save();
   
        
           return response()->json([
            'success' => 'Category Edited'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id)->delete();
        return response()->json([
            'success' => 'Category Deleted'
        ]);
    }
}
