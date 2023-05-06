<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments',[
            'appointments'=>$appointments->orderBy("updated_at","desc")->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $patients=new Patient();
        return view('admin.appointment-add',[
            'patients'=>$patients->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->all());
        return redirect()
            ->route('appointments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment): View|Application|Factory
    {
        $patient=new Patient();
        return view('admin.appointment-edit',[
            'patients'=>$patient->all(),
            'appointment'=>$appointment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validated();
        $appointment->update($validated);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->back();
    }

    public function show_prescriptions(Appointment $appointment):View
    {
        $prescriptions=$appointment->prescriptions()->orderBy("updated_at","desc")->paginate(10);
//        dd($prescriptions);
        return view('admin.appointment-prescriptions',[
            'prescriptions'=>$prescriptions
        ]);
    }


    public function success(Appointment $appointment): RedirectResponse
    {
//        $status = request("status");
//        if ($status==1 || $status==2){
            $time=time();
            $appointment->status=1;
            $appointment->change_status=$time;
            $appointment->save();
//        }
        return redirect()->back();

    }
    public function cancel(Appointment $appointment): RedirectResponse
    {
//        $status = request("status");
//        if ($status==1 || $status==2){
            $time=time();
            $appointment->status=2;
            $appointment->change_status=$time;
            $appointment->save();
//        }
        return redirect()->back();

    }
}
