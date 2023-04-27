<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('admin.insurances');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('admin.insurance-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):String
    {
        return "store";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):String
    {
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id=null):View
    {
        return view('admin.insurance-edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):String
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):string
    {
        return "destroy";
    }
}