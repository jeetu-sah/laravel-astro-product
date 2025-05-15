<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'categories';
        return view('category.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'categories';
        $data['categories'] = Category::all();
        return view('category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categoryName' => 'required',
            'status' => 'required',
        ]);

        $insertRecord = [
            'parent_category_id' => $request->parentCategory ?? NULL,
            'slug_name' => Str::slug($request->categoryName, '-'),
            'status' => $request->status,
            'user_id' => Auth::id(),
            'translations' => [
                'en' => [
                    'name' => $request->categoryName,
                    'short_description' => $request->shortDescription,
                    'description' => $request->descriptionCategory
                ]
            ]
        ];

        $result = Category::create($insertRecord);

        if ($result) {
            return redirect()->back()->with(["msg" => "<div class='bg-success text-white'><strong>Success </strong>  Record Insert Successfully !!! </div>"]);
        } else {
            return redirect()->back()->with(["msg" => "<div class='bg-danger text-black'><strong>Wrong </strong>  Something went wrong, please try again !!! </div>"]);
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
        $category = Category::find($id);
        if ($category->delete()) {
            return json_encode(['status' => 200, 'msg' => __('messages.record_delete_successfully')]);
        } else {
            return json_encode(['status' => 200, 'msg' => __('messages.something_went_wrong')]);
        }
    }

    /**
     * get the specified.
     */
    public function list()
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Category::count();


        $categoryQuery = Category::query();
        $categories = $categoryQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($categories->count() > 0) {
            $i = 1;
            foreach ($categories as $category) {
                $change_credential = NULL;
                $edit_btn = '<a href="' . route("category.edit", [$category->id]) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';

                //if(Auth::user()->isAbleTo('change-user-credential')){
                $change_credential = '<a href="' . route("category.destroy", [$category->id]) . '"  data-toggle="modal"  data-toggle="tooltip" title="Edit Record" class="btn btn-danger deleteCategory" style="margin-right: 5px;">
						<i class="fas fa-trash"></i> 
					  </a>';
                //}
                $row = [];
                $row['sn'] = '<a href="' . url("admin/roles/user_permission/$category->id?page=roles") . '">' . $category->id . '</a>';;

                $row['name'] = $category->name;

                $row['status'] = $category->status;

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
