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
        return redirect()->back();

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
        $datetime = new DateTime('tomorrow');
        $now = date("Y-m-d H:i:s", (strtotime('now')-(60*60*1)));//1402
        $today = date("Y-m-d H:i:s", (strtotime('today')));
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')));
        $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->paginate(10);
//        dd($appointments_today_tomorrow);
        return view('admin.appointments',[
            'appointments'=>$appointments_today_tomorrow
        ]);
    }
    public function tomorrow()
    {
        $appointments= new Appointment;
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')));
        $afterTomorrow = date("Y-m-d H:i:s", (strtotime('+2 day')));
        $appointments_tomorrow_afterTomorrow= $appointments->whereBetween('visit_time',[$tomorrow,$afterTomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_tomorrow_afterTomorrow
        ]);
    }
    public function week()
    {
        $appointments= new Appointment;
        $today = date("Y-m-d H:i:s", (strtotime('today')));
        $week = date("Y-m-d H:i:s", (strtotime('+1 week')));
        $appointments_week= $appointments->whereBetween('visit_time',[$today,$week])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_week
        ]);
    }
    public function month()
    {
        $appointments= new Appointment;
        $today = date("Y-m-d H:i:s", (strtotime('today')));
        $month = date("Y-m-d H:i:s", (strtotime('+1 month')));
        $appointments_month= $appointments->whereBetween('visit_time',[$today,$month])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$appointments_month
        ]);
    }
    public function period30()
    {
        $appointments= new Appointment;
        $before = date("Y-m-d H:i:s", (strtotime('-15 day')));
        $after = date("Y-m-d H:i:s", (strtotime('+15 day')));
        $between30= $appointments->whereBetween('visit_time',[$before,$after])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$between30
        ]);
    }
    public function before30()
    {
        $appointments= new Appointment;
        $before30 = date("Y-m-d H:i:s", (strtotime('-30 day')));
        $today = date("Y-m-d H:i:s", (strtotime('today')));
        $between30= $appointments->whereBetween('visit_time',[$before30,$today])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments',[
            'appointments'=>$between30
        ]);
    }
}
