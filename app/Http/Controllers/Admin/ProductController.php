<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ImageGallery;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


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
        $slug = Str::slug($request->productName, '-');
        $validatedData = $request->validate([
            'parentCategory' => 'required',
            'productName' => 'required',
            'productCode' => 'required',
            'basic_price' => 'required',
            'productType' => 'required',
            'productStatus' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // Prepare insert data
            $insertRecord = [
                'category_id'     => $request->parentCategory ?? 0,
                'product_code'    => $request->productCode,
                'basic_price'     => $request->basic_price,
                'product_status'  => $request->productStatus,
                'product_type'    => $request->productType,
                'user_id'         => Auth::id(),
                'translations' => [
                    'en' => [
                        'product_name'       => $request->productName,
                        'slug_name'          => $slug,
                        'short_description'  => $request->shortDescriptionProduct,
                        'description'        => $request->descriptionProduct,
                        'seo_keyword'        => $request->seo_keyword,
                        'meta_keyword'       => null,
                        'meta_description'   => null,
                    ]
                ]
            ];

            // Insert main product with translations (assuming translatable or manual logic)
            $productResult = Product::create($insertRecord);

            DB::commit();

            return redirect()->back()->with([
                'msg' => "<div class='alert alert-success'><strong>Success </strong> Record Inserted Successfully!</div>"
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'msg' => "<div class='alert alert-danger'><strong>Error </strong> Something went wrong: {$e->getMessage()}</div>"
            ]);
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
        $data['productsImages'] = $product->images;
        // echo "<pre>";
        // print_r($data['productsImages'][0]->pivot->id);exit;
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

    public function uploadImage(Request $request, $id)
    {
        $data['product'] = Product::find($id);

        if ($request->isMethod('get')) {
            $data['title'] = 'Upload Product Images';
            $data['images'] = ImageGallery::take(12)->orderByDesc('id')->get();
            return view('product.upload-image', $data);
        }

        if ($request->isMethod('post')) {
            if (count($request->images) > 0) {
                $data['product']->images()->attach($request->images);

                return redirect()->back()->with(["msg" => "<div class='bg-success text-white'><strong>Success </strong> Images save successfully !!! </div>"]);
            } else {
                return redirect()->back()->with(["msg" => "<div class='bg-warning text-white'><strong>Warning </strong> Please select at least one photo !!! </div>"]);
            }
        }
    }

    public function removeImage($productId, $productImageId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->images()->detach($productImageId);

            return json_encode(['status' => 200, 'msg' => __('messages.record_delete_successfully')]);
        } else {
            return json_encode(['status' => 200, 'msg' => __('messages.something_went_wrong')]);
        }
    }

    public function list()
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Product::count();


        $productQuery = Product::with(['images']);
        $products = $productQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($products->count() > 0) {
            $i = 1;
            foreach ($products as $product) {

                $change_credential = NULL;
                $edit_btn = '<a href="' . route("catalog.product.edit", [$product->id]) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                //if(Auth::user()->isAbleTo('change-user-credential')){
                $change_credential = '<a href="' . route("catalog.category.destroy", [$product->id]) . '"  data-toggle="modal"  data-toggle="tooltip" title="Edit Record" class="btn btn-danger deleteCategory" style="margin-right: 5px;">
						<i class="fas fa-trash"></i> 
					  </a>';
                //}
                $row = [];
                $row['product_code'] = '<a href="' . route("catalog.product.edit", [$product->id]) . '">' . $product->product_code . '</a>';

                $row['name'] = '<a href="' . route("catalog.product-varient.index", ['productId' => $product->id]) . '">' . $product->product_name . '</a>';;
                $row['product_sku'] = $product->product_sku;


                $row['images'] = '<img src="' . $product->productFirstImagePath . '" alt="Smiley face" width="42" height="42" style="vertical-align:bottom">';
                $row['status'] = '<span class="badge badge-danger">' . $product->product_status . '</span>';

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
