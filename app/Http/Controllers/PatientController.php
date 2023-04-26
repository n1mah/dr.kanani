<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;

class PatientController extends Controller
{
    public function index():View
    {
        return view('admin.patients');
    }
    public function create():View
    {
        return view('admin.patient-add');
    }
    public function edit():View
    {
        return view('admin.patient-edit ');
    }
    public function show()
    {
        return "show";
    }
    public function store()
    {
        return "store";
    }
    public function update()
    {
        return "update";
    }
    public function destroy()
    {
        return "destroy";
    }
}
