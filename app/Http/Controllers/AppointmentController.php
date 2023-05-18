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

    public function index(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.index',[
            'appointments'=>$appointments->orderBy("id","desc")->paginate(10)
        ]);
    }

    public function create(): View
    {
        $patient_id=null;if(request("patient")){$patient_id=request("patient");}
        $patients=new Patient();
        return view('admin.appointments.add',[
            'patients'=>$patients->where("is_active",true)->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'patient_id'=>$patient_id
        ]);
    }

    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        Appointment::create($request->all());
        return redirect()->route('appointments');
    }


    public function show(Appointment $appointment)
    {
        $prescriptions=$appointment->prescriptions()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.appointments.show',[
            'appointment'=>$appointment,
            'prescriptions'=>$prescriptions,
            'back'=> redirect()->back()->getTargetUrl()
        ]);
    }


    public function edit(Appointment $appointment): View|Application|Factory
    {
        $patient=new Patient();
        return view('admin.appointments.edit',[
            'patients'=>$patient->where("is_active",true)->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'appointment'=>$appointment,
            'back'=> redirect()->back()->getTargetUrl()
        ]);
    }


    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validated();
        $appointment->update($validated);
        return redirect()->route('appointments');
    }


    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('appointments');
    }

    public function show_prescriptions(Appointment $appointment):View
    {
        $patient_id=null;if(request("id")){$patient_id=request("id");}
        $prescriptions=$appointment->prescriptions()->orderBy("updated_at","desc")->paginate(10);
        return view('admin.appointments.prescriptions',[
            'prescriptions'=>$prescriptions,
            'back'=> redirect()->back()->getTargetUrl(),
            'patient_id_add'=>$patient_id
        ]);
    }

    public function success(Appointment $appointment)
    {
        if ($appointment->status==0){
            $patient_id=null;if(request("patient")){$patient_id=request("patient");}
            $patient= new Patient;
            $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
            return view('admin.financial_transactions.add',[
                "methods"=>$methods,
                'appointment'=>$appointment,
                'patient'=>$appointment->patient,
                'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),//->where("is_active",true)
                'patient_id'=>$patient_id,
                'visit'=>'yes',
                'title_h1'=>'تایید ویزیت و ثبت پرداخت'
            ]);
        }else{
            return redirect()->route('financials');
        }
    }
    public function success_work(Appointment $appointment):void
    {
        if ($appointment->status==0){
            $time=time();
            $appointment->status=1;
            $appointment->change_status=$time;
            $appointment->save();
        }
    }
    public function success_save(Appointment $appointment): RedirectResponse
    {
//        $time=time();
//        $appointment->status=1;
//        $appointment->change_status=$time;
//        $appointment->save();
//        return redirect()->back();
    }
    public function cancel(Appointment $appointment): RedirectResponse
    {
            $time=time();
            $appointment->status=2;
            $appointment->change_status=$time;
            $appointment->save();
        return redirect()->back();
    }

    public function today()
    {
        $appointments= new Appointment;
        $today = $this->GetToday();
        $tomorrow = $this->GetTomorrow();
        $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$appointments_today_tomorrow
        ]);
    }
    public function tomorrow(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments= new Appointment;
        $tomorrow = $this->GetTomorrow();
        $dayAfterTomorrow = $this->GetAddDay(2);
        $appointments_tomorrow_afterTomorrow= $appointments->whereBetween('visit_time',[$tomorrow,$dayAfterTomorrow])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$appointments_tomorrow_afterTomorrow
        ]);
    }
    public function week(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments= new Appointment;
        $today = $this->GetToday();
        $after7day = $this->GetAddDay(7);
        $appointments_7= $appointments->whereBetween('visit_time',[$today,$after7day])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$appointments_7
        ]);
    }
    public function month(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments= new Appointment;
        $today = $this->GetToday();
        $after30day = $this->GetAddDay(30);
        $appointments_30= $appointments->whereBetween('visit_time',[$today,$after30day])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$appointments_30
        ]);
    }
    public function period30(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments= new Appointment;
        $before15day = $this->GetSubDay(15);
        $after15day = $this->GetAddDay(15);
        $between30days= $appointments->whereBetween('visit_time',[$before15day,$after15day])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$between30days
        ]);
    }
    public function before30Day(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $appointments= new Appointment;
        $before30day = $this->GetSubDay(30);
        $today = $this->GetToday();
        $between30days= $appointments->whereBetween('visit_time',[$before30day,$today])->orderBy("visit_time","asc")->paginate(10);
        return view('admin.appointments.index',[
            'appointments'=>$between30days
        ]);
    }
    public function canceled(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.index',[
            'appointments'=>$appointments->whereIn("status",[2])->orderBy("id","desc")->paginate(10)
        ]);
    }
    public function succeed(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.index',[
            'appointments'=>$appointments->whereIn("status",[1])->orderBy("id","desc")->paginate(10)
        ]);
    }
    public function initial_status(): View|Application|Factory
    {
        $appointments= new Appointment;
        return view('admin.appointments.index',[
            'appointments'=>$appointments->whereIn("status",[0])->orderBy("id","desc")->paginate(10)
        ]);
    }
}
