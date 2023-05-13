<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;

class PatientController extends Controller
{
    public function index():View
    {
        $patient= new Patient;
        return view('admin.patients.patients',[
            'patients'=>$patient->orderBy("created_at","asc")->paginate(10)
        ]);
    }
    public function create():View
    {
        $insurances=new Insurance();
        return view('admin.patients.patient-add',[
            'insurances'=>$insurances->all()
        ]);
    }
    public function edit(Patient $patient):View
    {
        $insurances=new Insurance();
        return view('admin.patients.patient-edit',[
            'patient'=>$patient,
            'insurances'=>$insurances->all()
        ]);
    }
    public function show(Patient $patient):View
    {
        return view('admin.patients.patient',[
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

    public function show_appointments(Patient $patient):View
    {
//        dd(redirect()->back());
        $appointments=$patient->appointments()->orderBy("visit_time","desc")->paginate(10);
        return view('admin.patients.patient-appointments',[
            'appointments'=>$appointments
        ]);
    }
    public function show_prescriptions(Patient $patient):View
    {
        $prescriptions=$patient->prescriptions()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.patients.patient-prescriptions',[
            'prescriptions'=>$prescriptions
        ]);
    }
    public function show_reports(Patient $patient):View
    {
        $reports=$patient->reports()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.patients.patient-reports',[
            'reports'=>$reports,
            'patient'=>$patient
        ]);
    }
    public function search()
    {
        $search=request("search");
        $patients= Patient::join('insurances', 'insurances.id', '=', 'patients.insurance_id')
                           ->where('firstname', 'LIKE', '%'.$search.'%')
                           ->orWhere('lastname', 'LIKE', '%'.$search.'%')
                           ->orWhere('national_code', 'LIKE', '%'.$search.'%')
                           ->orWhere('insurances.title', 'LIKE', '%'.$search.'%');
        return view('admin.patients.patients',[
            'patients'=>$patients->orderBy("patients.updated_at","desc")->paginate(10)
        ]);
    }
}
