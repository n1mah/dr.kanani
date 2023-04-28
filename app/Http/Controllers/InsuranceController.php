<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $insurance= new Insurance();
        return view('admin.insurances',[
            'insurances'=>$insurance->all()
        ]);

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
    public function store(InsuranceRequest $request): \Illuminate\Http\RedirectResponse
    {
        Insurance::create($request->all());
        return redirect()
            ->route('insurances');
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
    public function edit(Insurance $insurance):View
    {
//        return $insurance;
        return view('admin.insurance-edit',[
           "insurance" =>$insurance
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceRequest $request,Insurance $insurance): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $insurance->update($validated);
        return redirect()
            ->route('insurances');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):string
    {
        return "destroy";
    }
}
