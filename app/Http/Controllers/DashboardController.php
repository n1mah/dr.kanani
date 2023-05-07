<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments= new Appointment;
        $datetime = new DateTime('tomorrow');
//        $now = date("Y-m-d H:i:s", (strtotime('now')-(60*60*1)));//1402
        $today = date("Y-m-d H:i:s", (strtotime('today')));
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')));
//dd($today,$tomorrow);
       $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->get();
//        $b= $appointments->whereBetween('visit_time',[0,168345711960])->orderBy("updated_at","desc")->get();
//        $b= $appointments->whereBetween('visit_time',[strtotime("today"),strtotime("today")])->orderBy("updated_at","desc")->get();
//        $b= $appointments->whereDate('visit_time',"<=",16834571196)->orderBy("updated_at","desc")->get();
//       $b= $appointments->whereBetween('visit_time',[strtotime("today"),strtotime("tomorrow")])->orderBy("updated_at","desc")->get();
//        dd($b);
        return view('admin.home',[
                'appointments'=>$appointments_today_tomorrow
            ]);
    }
}
