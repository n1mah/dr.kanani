<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
//        dd(1);
        $images = Image::all();
        return view('admin.image', compact('images'));
    }
    public function store(ImageRequest $request)
    {
//        dd($request->all());
//        dd($request->image->extension());
//        $imagePath = $request->file('image')->store('public/images');
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $image = new Image([
            'description' => $request->get('description'),
            'image_path' => $imageName,
        ]);
        $image->save();
        return redirect('/imagess')->with('success', 'Image uploaded successfully');


    }
}
