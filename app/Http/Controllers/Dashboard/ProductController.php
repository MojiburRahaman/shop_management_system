<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\{
    ProductValidate
};
use App\Models\{
    Brand,
    Category,
    Product,
};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest('id')->get();
        $categories = Category::latest('id')->get();
        $brands = Brand::latest('id')->get();
        return view('backend.product.index', [
            'products' => $products,
            'categories' => $categories,
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
    // public function store(Request $request)
    public function store(ProductValidate $request)
    {
        return $request;

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->barcode = $request->barcode;
        $product->sku_no = $request->sku_no;
        $product->purchase_rate = $request->purchase_rate;
        $product->sale_rate = $request->sale_rate;
        $product->stock = $request->stock;

        if ($request->hasFile('thumbnail')) {

            $file = $request->file('thumbnail');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/thumbnail/', $filename);

            $product->thumbnail = $filename;
        } else {
            $product->thumbnail = 'default-thumbnail.png';
        }

        $product->save();

        return response()->json([
            'success' => 'Product Added'
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        $categories = Category::latest('id')->get();
        $brands = Brand::latest('id')->get();
        $product = Product::findorfail($id);
        $html = view('backend.modal.edit-product', compact('product', 'categories', 'brands'))->render();

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
        $product =  Product::findorfail($request->id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->barcode = $request->barcode;
        $product->sku_no = $request->sku_no;
        $product->purchase_rate = $request->purchase_rate;
        $product->sale_rate = $request->sale_rate;
        $product->stock = $request->stock;

        if ($request->hasFile('thumbnail')) {

            $old_thumbnail = public_path('storage/thumbnail/' . $product->thumbnail);
            if (file_exists($old_thumbnail)) {
                @unlink($old_thumbnail);
            }

            $file = $request->file('thumbnail');
            $filename = Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/thumbnail/', $filename);

            $product->thumbnail = $filename;
        }
        $product->save();

        return response()->json([
            'success' => 'Product Edited SuccessFully'
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
        Product::findorfail($id)->delete();
        return response()->json([
            'success' => 'Product Deleted Successfully'
        ]);
    }
}
