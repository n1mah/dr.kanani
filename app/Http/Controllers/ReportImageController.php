<?php

namespace App\Http\Controllers;

use App\Models\ReportImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageAlia;

class ReportImageController extends Controller
{

    public function store(Array $files,$report_id):void
    {
        $count=0;
        foreach($files as $file){
            $size=(int)ceil($file->getSize()/1000);     //Kb
            if ($size < 2000 && $size != 0) {
                $count++;
                $pass = $file->extension();
                $imageName = time() . '-r' . $count . '.' . $pass;
                $img = ImageAlia::make($file)->widen(600);
                $img->save(public_path("images/reports/" . $imageName));
                $reportImage = new ReportImage([
                    'image_path' => $imageName,
                    'report_id' => $report_id,
                ]);
                $reportImage->save();
            }
        }
    }
}
