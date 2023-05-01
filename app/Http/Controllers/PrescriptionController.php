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

    public function create2():View
    {
        $patient_id=request("patient_id");

        $patient=new Patient();
//        dd($patient_id);

        $patientN=$patient->find($patient_id)->first();


        $appointment=new Appointment();
        return view('admin.prescription-add-level2',[
            'appointments'=>$appointment->where("patient_id",$patient_id)->orderby("visit_time")->get(),
            'patient_model'=>$patientN
        ]);
    }
    public function create3(Patient $patient):View
    {
        $appointment=new Appointment();


        $appointment_id=request("appointment_id");
        if ($appointment_id==="null"){
            $appointmentN = new Appointment;
            $appointmentN->patient_id =$patient->id;
            $appointmentN->reason = request("reason");
            $appointmentN->type = request("type");
            $appointmentN->text_prescription = "";
            $appointmentN->save();
        }else{

        }
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
