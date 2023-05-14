<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use DateTime;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public $timeAdded=(3600*(4.5)); //4.5*3600

    public function GetToday()
    {
        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->timestamp)+$this->timeAdded));
    }
    public function GetTomorrow()
    {
        return date("Y-m-d H:i:s", ((Verta::tomorrow("Asia/Tehran")->timestamp)+$this->timeAdded));
    }
    public function GetAddDay($day)
    {

        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->addDays($day)->timestamp)+$this->timeAdded));
    }
    public function GetSubDay($day)
    {
        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->subDays($day)->timestamp)+$this->timeAdded));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments->orderBy("id","desc")->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $patients=new Patient();
        return view('admin.appointments.appointment-add',[
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

        return view('admin.appointments.appointment-show',[
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
        return view('admin.appointments.appointment-edit',[
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
        return view('admin.appointments.appointment-prescriptions',[
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
        $today = $this->GetToday();
//        echo $today=Verta::today("Asia/Tehran")->timestamp;
//        dd($today);
        $tomorrow = $this->GetTomorrow();
////        dd($tomorrow);
        $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments_today_tomorrow
        ]);
    }
    public function tomorrow()
    {
        $appointments= new Appointment;
        $tomorrow = $this->GetTomorrow();
//        dd(Verta::today("Asia/Tehran"),Verta::today("Asia/Tehran")->addDay());
//        dd(Verta::today("Asia/Tehran"),Verta::today("Asia/Tehran")->addDays(2));
        $dayAfterTomorrow = $this->GetAddDay(2);
        $appointments_tomorrow_afterTomorrow= $appointments->whereBetween('visit_time',[$tomorrow,$dayAfterTomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments_tomorrow_afterTomorrow
        ]);
    }
    public function week()
    {
        $appointments= new Appointment;
        $today = $this->GetToday();
        $week = $this->GetAddDay(7);
        $appointments_week= $appointments->whereBetween('visit_time',[$today,$week])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments_week
        ]);
    }
    public function month()
    {
        $appointments= new Appointment;
        $today = $this->GetToday();
        $month = $this->GetAddDay(30);
        $appointments_month= $appointments->whereBetween('visit_time',[$today,$month])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments_month
        ]);
    }
    public function period30()
    {
        $appointments= new Appointment;
        $before = $this->GetSubDay(15);
        $after = $this->GetAddDay(15);
        $between30= $appointments->whereBetween('visit_time',[$before,$after])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$between30
        ]);
    }
    public function before30Day()
    {
        $appointments= new Appointment;
        $before30 = $this->GetSubDay(30);
        $today = $this->GetToday();
        $between30= $appointments->whereBetween('visit_time',[$before30,$today])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.appointments',[
            'appointments'=>$between30
        ]);
    }
    public function canceled(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments->whereIn("status",[2])->orderBy("id","desc")->paginate(10)
        ]);
    }
    public function succeed(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments->whereIn("status",[1])->orderBy("id","desc")->paginate(10)
        ]);
    }
    public function initial_status(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.appointments',[
            'appointments'=>$appointments->whereIn("status",[0])->orderBy("id","desc")->paginate(10)
        ]);
    }
}
