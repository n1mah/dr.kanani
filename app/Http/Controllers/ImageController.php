<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageAlia;

class ImageController extends Controller
{
    public function store(Array $files,$prescription_id):void
    {
        $count=0;
        foreach($files as $file){
            $size=(int)ceil($file->getSize()/1000);     //Kb
            if ($size < 2000 && $size != 0) {
                $count++;
                $pass = $file->extension();
                $imageName = time() . '-c' . $count . '.' . $pass;
                $img = ImageAlia::make($file)->widen(600);
                $img->save(public_path("images/prescriptions/" . $imageName));
                $image = new Image([
                    'image_path' => $imageName,
                    'prescription_id' => $prescription_id,
                ]);
                $image->save();
            }
        }
    }
}
