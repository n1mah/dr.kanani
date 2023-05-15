<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index():View
    {
        $insurance= new Insurance();
        return view('admin.insurances.index',[
            'insurances'=>$insurance->orderBy("id","desc")->paginate(10)
        ]);

    }

    public function create():View
    {
        return view('admin.insurances.add');
    }

    public function store(InsuranceRequest $request): \Illuminate\Http\RedirectResponse
    {
        Insurance::create($request->all());
        return redirect()->route('insurances');
    }
    public function edit(Insurance $insurance):View
    {
        return view('admin.insurances.edit',[
           "insurance" =>$insurance
        ]);
    }

    public function update(InsuranceRequest $request,Insurance $insurance): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $insurance->update($validated);
        return redirect()->route('insurances');
    }

    public function destroy(Insurance $insurance): \Illuminate\Http\RedirectResponse
    {
         $insurance->delete();
         return redirect()->back();
    }

    public function search(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search=request("search");
        $insurances= Insurance::where('title', 'LIKE', '%'.$search.'%');
        return view('admin.insurances.index',[
            'insurances'=>$insurances->orderBy("id","desc")->get(),
            'search'=>'has'
        ]);
    }
}
