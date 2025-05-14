<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ImageGallery;
use App\Http\Controllers\Controller;

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
        $data['title'] = 'Product Edit';
        $data['product'] = $product;
        return view('product.edit', $data);
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
    public function destroy(Product $product) {}

    public function uploadImage($id)
    {
        $data['title'] = 'Upload Product Images';
        $data['product'] = Product::find($id);
         $data['images'] = ImageGallery::take(12)->orderByDesc('id')->get();
        return view('product.upload-image', $data);
        // echo "<pre>";
        // print_r($product);exit;
    }

    public function list()
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Product::count();


        $productQuery = Product::query();
        $products = $productQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($products->count() > 0) {
            $i = 1;
            foreach ($products as $product) {
                $change_credential = NULL;
                $edit_btn = '<a href="' . route("product.edit", [$product->id]) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                //if(Auth::user()->isAbleTo('change-user-credential')){
                $change_credential = '<a href="' . route("category.destroy", [$product->id]) . '"  data-toggle="modal"  data-toggle="tooltip" title="Edit Record" class="btn btn-danger deleteCategory" style="margin-right: 5px;">
						<i class="fas fa-trash"></i> 
					  </a>';
                //}
                $row = [];
                $row['product_code'] = '<a href="' . url("admin/roles/user_permission/$product->product_code") . '">' . $product->product_code . '</a>';;

                $row['name'] = $product->product_name;

                $row['images'] = $product->product_status;
                $row['status'] = $product->product_status;

                $row['action'] = $edit_btn . " " . $change_credential;

                $rows[] = $row;
            }
        }

        $json_data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($totalRecord),
            "recordsFiltered" => intval($totalRecord),
            "data"            => $rows
        );

        return json_encode($json_data);
        exit;
    }
}
