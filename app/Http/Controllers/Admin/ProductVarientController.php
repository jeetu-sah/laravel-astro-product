<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ImageGallery;


class ProductVarientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        $data['title'] = 'List Product';
        $data['product'] = Product::find($productId);
        $data['categories'] = Category::all();
        return view('product-varient.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($productId)
    {
        $data['title'] = 'List Product';
        $data['product'] = Product::find($productId);
        $data['productAttributes'] = Attribute::with(['values'])->get();
        // echo "<pre>";
        // print_r($data['productAttributes']);
        // exit;
        $data['categories'] = Category::all();
        return view('product-varient.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {

        $validatedData = $request->validate([
            'product_sku' => 'required|string|max:255|unique:product_variants,sku',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::find($productId);

            if (!$product) {
                throw new \Exception("Product not found.");
            }

            $productVariant = ProductVariant::create([
                'product_id' => $product->id,
                'sku' => $request->product_sku,
                'price' => $request->price,
                'stock' => $request->quantity,
                'alert_quantity' => $request->alertQuantity,
                'product_variants_status' => $request->availableStatus,
            ]);

            if (!$productVariant) {
                throw new \Exception("Product variant creation failed.");
            }

            $arrangeAttributes = [];

            if ($request->attributes) {
                $attributes = $request->input('attributes');

                $filteredAttributes = array_filter($attributes, function ($value) {
                    return !empty($value);
                });

                foreach ($filteredAttributes as $attributeId => $attributeValue) {
                    $arrangeAttributes[] = [
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $attributeValue
                    ];
                }
            }

            if (count($arrangeAttributes) > 0) {
                $productVariant->varientAttributes()->createMany($arrangeAttributes);
            }

            DB::commit();

            return redirect()->back()->with(["msg" => "<div class='alert alert-success'><strong>Success </strong> Record created successfully !!! </div>"]);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Product variant creation failed: ' . $e->getMessage());
            return redirect()->back()->with(["msg" => "<div class='alert alert-danger'><strong>Warning </strong> Something went wrong, please try again !!! </div>"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function list($productId)
    {

        $limit = request()->input('length');
        $start = request()->input('start');
        $query = ProductVariant::where('product_id', $productId);
        $totalRecord = $query->count();

        // echo "<pre>";
        // print_r($totalRecord);exit;
        $productVarients = $query->skip($start)->take($limit)->get();

        $rows = [];
        if ($productVarients->count() > 0) {
            $i = 1;
            foreach ($productVarients as $productVarient) {

                $change_credential = NULL;
                $edit_btn = '<a href="' . route("catalog.product.edit", [$productVarient->id]) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                $change_credential = '<a href="' . route("catalog.category.destroy", [$productVarient->id]) . '"  data-toggle="modal"  data-toggle="tooltip" title="Edit Record" class="btn btn-danger deleteCategory" style="margin-right: 5px;">
						<i class="fas fa-trash"></i> 
					  </a>';
                $uploadImage = '<a href="' . route("image-gallery.map-images", ['image-for' => 'product_variants', 'id' => $productVarient->id]) . '"  title="Upload Image" class="btn btn-warning" style="margin-right: 5px;">
						<i class="fas fa-images"></i> 
					  </a>';

                $row = [];
                $row['price'] = $productVarient->price;

                $row['stock'] = $productVarient->stock;
                $row['product_sku'] = $productVarient->sku;


                $row['images'] = '<img src="' . $productVarient->productFirstImagePath . '" alt="Smiley face" width="42" height="42" style="vertical-align:bottom">';
                $row['status'] = $productVarient->product_variants_status;

                $row['action'] = $edit_btn . " " . $change_credential . " " . $uploadImage;

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


    public function  uploadImage(Request $request, $id)
    {
        $productVarient = ProductVariant::find($id);
        if ($productVarient) {
            if (count($request->images) > 0) {
                $productVarient->images()->attach($request->images);

                return redirect()->back()->with(["msg" => "<div class='alert alert-success'><strong>Success </strong> Images save successfully !!! </div>"]);
            } else {
                return redirect()->back()->with(["msg" => "<div class='alert alert-danger'><strong>Warning </strong> Please select at least one photo !!! </div>"]);
            }
        } else {
             return redirect()->back()->with(["msg" => "<div class='alert alert-danger'><strong>Warning </strong> Please select at least one photo !!! </div>"]);
        }
    }
}
