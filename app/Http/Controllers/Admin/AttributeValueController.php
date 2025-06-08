<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($attributeId)
    {
        $data['title'] = 'Attribute Values';
        $data['attribute'] = Attribute::find($attributeId);
        $data['attributeValues'] = AttributeValue::where('attribute_id', $attributeId)->get();
       
        return view('attribute-values.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $attributeId)
    {
        $validatedData = $request->validate([
            'attributeValue' => 'required',
            'sortOrder' => 'required'
        ]);

        $insertRecord = [
            'value' => $request->attributeValue,
            'sort_order' => $request->sortOrder,
            'slug' => Str::slug($request->attributeValue, '-'),
            'attribute_id' => $attributeId,

            'translations' => [
                'en' => [
                    'name' => $request->attributeValue
                ]
            ]
        ];

        $result = AttributeValue::create($insertRecord);

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
