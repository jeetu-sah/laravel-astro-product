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

        $result = Category::create([
            'parent_category_id' => $request->parentCategory ?? NULL,
            'slug_name' => Str::slug($request->categoryName, '-'),
            'name' => $request->categoryName,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

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
        //
    }
}
