<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'List Attribute';
        $data['categories'] = Attribute::all();
        return view('attribute.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Create Attribute';
        $data['categories'] = Attribute::all();
        $data['fieldTypes'] = DB::table('field_types')->get();
        return view('attribute.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'attribute_name' => 'required',
            'attribute_code' => 'required',
        ]);

        $insertRecord = [
            'code' => $request->attribute_code,
            'slug_name' => Str::slug($request->attribute_name, '-'),
            'status' => $request->status,
            'is_required' => ($request->is_required == 'yes') ? true : false,
            'is_filterable' => ($request->is_filterable == 'yes') ? true : false,
            'type' => $request->type,
            'translations' => [
                'en' => [
                    'name' => $request->attribute_name,
                    'description' => $request->description,
                ]
            ]
        ];

        $result = Attribute::create($insertRecord);

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
        echo "<pre>";
        print_r($id);
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Attribute';
        $data['attribute'] = Attribute::find($id);
     
        return view('attribute.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        echo "<pre>";
        print_r($id);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * get the specified.
     */
    public function list()
    {
        $limit = request()->input('length');
        $start = request()->input('start');
        $totalRecord = Attribute::count();


        $categoryQuery = Attribute::query();
        $attributes = $categoryQuery->skip($start)->take($limit)->get();

        $rows = [];
        if ($attributes->count() > 0) {
            foreach ($attributes as $attribute) {
                $edit_btn = '<a href="' . route("attributes.edit", [$attribute->id]) . '" data-toggle="tooltip" title="Edit Record" class="btn btn-primary" style="margin-right: 5px;">
						<i class="fas fa-edit"></i> 
					  </a>';
                $row = [];
                $row['name'] =  '<a href="' . route("attributes.attributes-values.index", [$attribute->id])  . '">' . $attribute->name . '</a>';
                $row['type'] = $attribute->type;
                $row['status'] = $attribute->status;

                $row['action'] = $edit_btn;

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
