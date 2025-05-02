<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'List Product';
        $data['categories'] = Category::all();
        return view('product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Create Product';
        $data['categories'] = Category::all();
        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'parentCategory' => 'required',
            'productName' => 'required',
            'productCode' => 'required',
            'price' => 'required',
            'sellingPrice' => 'required',
            'quantity' => 'required',
            'alertQuantity' => 'required',
            'productType' => 'required',
            'productStatus' => 'required',
            'availableStatus' => 'required',
        ]);

        $slug = Str::slug($request->productName, '-');
        $slugExists = Product::where('slug_name', '=', $slug)->exists();

        $productResult = Product::create([
            'category_id'   => $request->parentCategory,
            'product_name'  => $request->productName,
            'slug_name'     => ($slugExists) ? $slug . '-' . Str::random(10) : $slug,
            'product_code'  => $request->productCode,
            'price'         => $request->price,
            'selling_price' => $request->sellingPrice,
            'quantity'      => $request->quantity,
            'alert_quantity'    => $request->alertQuantity,
            'availibility'      => $request->availableStatus,
            'product_status'    => $request->productStatus,
            'product_type'      => $request->productType,
            'short_description' => null,
            'description'       => $request->descriptionProduct,
        ]);

        if ($productResult) {
            return redirect()->back()->with(["msg" => "<div class='bg-success text-white'><strong>Success </strong>  Record Insert Successfully !!! </div>"]);
        } else {
            return redirect()->back()->with(["msg" => "<div class='bg-danger text-black'><strong>Wrong </strong>  Something went wrong, please try again !!! </div>"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
