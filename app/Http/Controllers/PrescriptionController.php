<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $prescriptions= new Prescription;
        return view('admin.prescriptions',[
            'prescriptions'=>$prescriptions->orderBy("updated_at","desc")->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $patients=new Patient();
        return view('admin.prescription-add-level1',[
            'patients'=>$patients->all()
        ]);
    }

    public function create2(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $patient_id=request("patient_id");
        $patient=new Patient();
        try {
            $patientN=$patient->findOrFail($patient_id)->where('national_code', $patient_id)->get()->first();
        }catch(\Exception $exception){
          return  redirect()->back()->withErrors(['patient_err' => ['لطفا بیمار را از لیست بیماران انتخاب کنید (نامعتبر)']]);
        }
        $appointment=new Appointment();
        return view('admin.prescription-add-level2',[
            'appointments'=>$appointment->where("patient_id",$patient_id)->orderby("visit_time")->get(),
            'patient'=>$patientN
        ]);

    }
    public function create2_error(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patients=new Patient();
        return view('admin.prescription-add-level1',[
            'patients'=>$patients->all()
        ]);
    }
    public function store(Patient $patient,StorePrescriptionRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $validated = $request->all();
        $appointment_id=$validated["appointment_id"];
        if ($appointment_id==="" || is_null($appointment_id)){
            $appointmentN = new Appointment;
            $appointmentN->patient_id =$patient->national_code;
            $appointmentN->descriptions =$validated["reason"];
            $appointmentN->type = $validated["type"];
            $appointmentN->visit_time =time();
            $appointmentN->save();
            $validated["appointment_id"]=$appointmentN->id;
        }
        $prescription= Prescription::create($validated);
        return view('admin.prescription-add-level3',[
            'prescription'=>$prescription,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription):View|RedirectResponse
    {
        return view('admin.prescription-edit',[
            'prescription'=>$prescription,
        ]);
    }
    public function update(Prescription $prescription):View|RedirectResponse
    {
        $prescription->text_prescription=request("text_prescription");
        $prescription->save();
        return redirect()
            ->route('prescriptions');
    }
    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}
