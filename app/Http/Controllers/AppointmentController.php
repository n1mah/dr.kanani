<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use DateTime;
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
        $prescriptions=$appointment->prescriptions()->orderBy("updated_at","desc")->paginate(10);

        return view('admin.appointment-show',[
            'appointment'=>$appointment,
            'prescriptions'=>$prescriptions
        ]);
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
        return redirect()->route('appointments');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('appointments');
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

    public function today()
    {
        $appointments= new Appointment;
        $today = date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600)));
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')+(4.5*3600)));
        $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_today_tomorrow
        ]);
    }
    public function tomorrow()
    {
        $appointments= new Appointment;
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')+(4.5*3600)));
        $dayAfterTomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow +1 day')+(4.5*3600)));
        $appointments_tomorrow_afterTomorrow= $appointments->whereBetween('visit_time',[$tomorrow,$dayAfterTomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_tomorrow_afterTomorrow
        ]);
    }
    public function week()
    {
        $appointments= new Appointment;
        $today = date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600)));
        $week = date("Y-m-d H:i:s", (strtotime('today +7 day')+(4.5*3600)));
        $appointments_week= $appointments->whereBetween('visit_time',[$today,$week])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_week
        ]);
    }
    public function month()
    {
        $appointments= new Appointment;
        $today = date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600)));
        $month = date("Y-m-d H:i:s", (strtotime('today +30 day')+(4.5*3600)));
        $appointments_month= $appointments->whereBetween('visit_time',[$today,$month])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_month
        ]);
    }
    public function period30()
    {
        $appointments= new Appointment;
        $before = date("Y-m-d H:i:s", (strtotime('today -15 day')+(4.5*3600)));
        $after = date("Y-m-d H:i:s", (strtotime('today +15 day')+(4.5*3600)));
        $between30= $appointments->whereBetween('visit_time',[$before,$after])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$between30
        ]);
    }
    public function before30Day()
    {
        $appointments= new Appointment;
        $before30 = date("Y-m-d H:i:s", (strtotime('today -30 day')+(4.5*3600)));
        $today = date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600)));
        $between30= $appointments->whereBetween('visit_time',[$before30,$today])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$between30
        ]);
    }
}
