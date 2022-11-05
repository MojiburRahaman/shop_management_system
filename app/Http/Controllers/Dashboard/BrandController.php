<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest('id')->get();
        return view('backend.brand.index', [
            'brands' => $brands,
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
            'title' => ['required', 'unique:brands,title'],
        ]);


        $Brand = new Brand;
        $Brand->title = $request->title;
        $Brand->slug = Str::slug($request->title);
        $Brand->save();

        return response()->json([
            'success' => 'Brand Added'
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
        $data = Brand::findorfail($id);
        $html = view('backend.modal.edit-brand-modal', compact('data'))->render();
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => ['required', 'exists:brands,id'],
            'title' => ['required', 'unique:brands,title,'.$request->id],
        ]);
        $Brand = Brand::findorfail($request->id);
        $Brand->title = $request->title;
        $Brand->slug = Str::slug($request->title);
        $Brand->save();


        return response()->json([
            'success' => 'Brand Edited'
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
        $Brand = Brand::findorfail($id)->delete();
        return response()->json([
            'success' => 'Brand Deleted'
        ]); //
    }
}
