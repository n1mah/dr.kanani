<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class PatientController extends Controller
{
    public function index()
    {
        return view('admin.patients');
    }
}
