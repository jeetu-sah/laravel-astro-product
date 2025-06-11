<?php

namespace App\Http\Controllers;

use App\Models\ImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Image Gallery | list';
        $data['images'] = ImageGallery::take(12)->orderByDesc('id')->get();
        return view('imageGallery.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Create Product';
        return view('imageGallery.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required',
        ], [
            'images.required' => 'please choose the images.',
        ]);
        $imageNameArr = $request->imageName;
        $imageNameAltArr = $request->altname;

        if (count($request->images) > 0) {
            foreach ($request->file('images') as $key =>  $image) {
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '-' . Str::uuid() . '.' . $extension;
                $picture = Storage::putFileAs("images_gallery", $image, $filename);

                //store in database
                ImageGallery::create([
                    'image_name' => $imageNameArr[$key],
                    'alt_name' => $imageNameAltArr[$key],
                    'name' => $filename,
                    'image_url' => $picture
                ]);
            }

            return redirect()->back()->with(["msg" => "<div class='bg-success text-white'><strong>Success </strong> Image upload successfully  !!! </div>"]);
        } else {

            return redirect()->back()->with(["msg" => "<div class='bg-danger text-white'><strong>Warning </strong> please choose the images  !!! </div>"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageGallery $imageGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImageGallery $imageGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageGallery $imageGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageGallery $imageGallery)
    {
        if ($imageGallery->delete()) {
            return redirect()->back()->with(["msg" => "<div class='bg-success text-white'><strong>Success </strong> Image delete successfully  !!! </div>"]);
        } else {
            return redirect()->back()->with(["msg" => "<div class='bg-danger text-white'><strong>Warning </strong> Something went wrong, please try again  !!! </div>"]);
        }
    }

    public function mapImages(Request $request)
    {
        $data['title'] = 'Map Images';
        $data['images'] = ImageGallery::take(12)->orderByDesc('id')->get();
        $imageFor = $request->query('image-for');
        $id = $request->query('id');
        $data['details'] = ImageGallery::mapdetails($imageFor, $id);
        // echo "<pre>";
        // print_r($data['details']);exit;
        return view('imageGallery.map-images', $data);
    }

    public function mappedImagesTo(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        exit;

    }
}
