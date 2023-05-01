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

    public function create2(): RedirectResponse | View
    {
        $patient_id=request("patient_id");
        $patient=new Patient();
        try {
            $patientN=$patient->findOrFail($patient_id)->where('national_code', $patient_id)->get()->first();
        }catch(\Exception $exception){
          return  redirect()->back()->withErrors(['patient_err' => ['لطفا بیمار را از لیست بیماران انتخاب کنید (نامعتبر)']]);
        }
//        dd($patientN->national_code);
        $appointment=new Appointment();
        return view('admin.prescription-add-level2',[
            'appointments'=>$appointment->where("patient_id",$patient_id)->orderby("visit_time")->get(),
            'patient'=>$patientN
        ]);
    }
    public function create3(Patient $patient):View
    {
        $type=request("type");
        $reason=request("reason");
        $appointment=new Appointment();
        $appointment_id=request("appointment_id");

        if ($appointment_id==="null"){
            $appointmentN = new Appointment;
            $appointmentN->patient_id =$patient->national_code;
            $appointmentN->descriptions =$reason;
            $appointmentN->type = request("type");
            $appointmentN->save();
            $appointment_id_=$appointmentN->id;
        }else{
            $appointment_id_=$appointment_id;
            $appointmentN=Appointment::find($appointment_id_)->first();
        }

        $prescription= new Prescription;
        $prescription->appointment_id=$appointment_id_;
        $prescription->type=$type;
        $prescription->reason=$reason;
        $prescription->save();
        return view('admin.prescription-add-level3',[
            'prescription'=>$prescription,
        ]);
    }
    public function create4(Prescription $prescription):View|RedirectResponse
    {
        $prescription->text_prescription=request("text_prescription");
        $prescription->save();
        return redirect()
            ->route('prescriptions');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrescriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrescriptionRequest $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}
