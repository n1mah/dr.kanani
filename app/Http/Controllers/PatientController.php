<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\Insurance;
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
            'patients'=>$patient->orderBy("updated_at","desc")->paginate(10)
        ]);
    }
    public function create():View
    {
        $insurances=new Insurance();
        return view('admin.patient-add',[
            'insurances'=>$insurances->all()
        ]);
    }
    public function edit(Patient $patient):View
    {
        $insurances=new Insurance();
        return view('admin.patient-edit',[
            'patient'=>$patient,
            'insurances'=>$insurances->all()
        ]);
    }
    public function show(Patient $patient):View
    {
        return view('admin.patient',[
            'patient'=>$patient,
        ]);
    }
    public function store(PatientRequest $request):string
    {
        Patient::create($request->all());
        return redirect()
            ->route('patients');
    }
    public function update(PatientUpdateRequest $request,Patient $patient)
    {
        $validated = $request->validated();
        $patient->update($validated);
        return redirect()
            ->route('patients');

    }
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->back();
    }
}
