<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;

class PatientController extends Controller
{
    public function index():View
    {
        $patient= new Patient;
        return view('admin.patients',[
            'patients'=>$patient->orderBy("created_at","desc")
        ]);
    }
    public function create():View
    {
        $insurances=new Insurance();
        return view('admin.patient-add',[
            'insurances'=>$insurances->all()
        ]);
    }
    public function edit():View
    {
        return view('admin.patient-edit');
    }
    public function show():string
    {
        return "show";
    }
    public function store():string
    {
        return "store";
    }
    public function update():string
    {
        return "update";
    }
    public function destroy():string
    {
        return "destroy";
    }
}
