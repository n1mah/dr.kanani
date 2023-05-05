<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reports= new Report;
        return view('admin.reports',[
            'reports'=>$reports->orderBy("updated_at","desc")->paginate(15)
        ]);
    }

}
