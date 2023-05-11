<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageAlia;

class ImageController extends Controller
{
    public function index()
    {
//        dd(1);
        $images = Image::orderBy("created_at","desc")->get();;
        return view('admin.image', compact('images'));
    }
    public function store(ImageRequest $request)
    {


        $files= $request->file("images");
        $count=0;
        foreach($files as $file){
            $count++;
            $pass=$file->extension();
//                if (strtolower($pass) == 'jpg' ||
//                    strtolower($pass) == 'png' ||
//                    strtolower($pass) == 'gif' ||
//                    strtolower($pass) == 'bmp' ||
//                    strtolower($pass) == 'webp'){
//                    $pass=$file->extension();
//                }elseif (strtolower($pass) == 'heic' || strtolower($pass) == 'image/heic' ){
//                    $pass="jpg";
//                }
            $imageName = time().'-c'.$count.'.'.$pass;
            $size=(int)ceil($file->getSize()/1000);     //Kb
//            $CompressPercent=90;
//            if ($size<100){
//                $CompressPercent=90;
//            }elseif ($size<500){
//                $CompressPercent=85;
//            }elseif ($size<1000){
//                $CompressPercent=70;
//            }elseif ($size<2000){
////                $CompressPercent=60;
//            }elseif ($size<3000){
//                $CompressPercent=45;
//            }elseif ($size<5000){
//                $CompressPercent=30;
//            }elseif ($size>=5000){
//                $CompressPercent=20;
//            }
            $img = ImageAlia::make($file)->widen(600);
//            $img->resize(300);
            $img->save(public_path("images/".$imageName));
            $image = new Image([
                'description' => $request->get('description'),
                'image_path' => $imageName,
            ]);
                $image->save();
//            $file->move(public_path('images'), $imageName);
        }

//        dd($request->all());
//        dd($request->image->extension());
//        $imagePath = $request->file('image')->store('public/images');

//        $imageName = time().'.'.$request->image->extension();
//        $request->image->move(public_path('images'), $imageName);
//        $image = new Image([
//            'description' => $request->get('description'),
//            'image_path' => $imageName,
//        ]);
//        $image->save();

        return redirect('/imagess')->with('success', 'Image uploaded successfully');


    }
}
