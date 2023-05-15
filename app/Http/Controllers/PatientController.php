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
    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient= new Patient;
        return view('admin.patients.index',[
            'patients'=>$patient->orderBy("created_at","asc")->paginate(10)
        ]);
    }

    public function create(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $insurances=new Insurance();
        return view('admin.patients.add',[
            'insurances'=>$insurances->all()
        ]);
    }

    public function edit(Patient $patient): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $insurances=new Insurance();
        return view('admin.patients.edit',[
            'patient'=>$patient,
            'insurances'=>$insurances->all()
        ]);
    }

    public function show(Patient $patient): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.patients.show',[
            'patient'=>$patient,
        ]);
    }

    public function store(PatientRequest $request):string
    {
        Patient::create($request->all());
        return redirect()->route('patients');
    }

    public function update(PatientUpdateRequest $request,Patient $patient)
    {
        $validated = $request->validated();
        $patient->update($validated);
        return redirect()->route('patients');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients');
    }

    public function show_appointments(Patient $patient): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments=$patient->appointments()->orderBy("visit_time","desc")->paginate(10);
        return view('admin.patients.appointments',[
            'appointments'=>$appointments,
            'back'=> redirect()->back()->getTargetUrl()
        ]);
    }

    public function show_prescriptions(Patient $patient): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $prescriptions=$patient->prescriptions()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.patients.prescriptions',[
            'prescriptions'=>$prescriptions,
            'back'=> redirect()->back()->getTargetUrl()
        ]);
    }

    public function show_reports(Patient $patient): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reports=$patient->reports()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.patients.reports',[
            'reports'=>$reports,
            'patient'=>$patient,
            'back'=> redirect()->back()->getTargetUrl()
        ]);
    }

    public function search(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search=request("search");
        $patients= Patient::join('insurances', 'insurances.id', '=', 'patients.insurance_id')
                           ->where('firstname', 'LIKE', '%'.$search.'%')
                           ->orWhere('lastname', 'LIKE', '%'.$search.'%')
                           ->orWhere('national_code', 'LIKE', '%'.$search.'%')
                           ->orWhere('insurances.title', 'LIKE', '%'.$search.'%');
        return view('admin.patients.index',[
            'patients'=>$patients->orderBy("patients.updated_at","desc")->get(),
            'search'=>'has'
        ]);
    }
}
