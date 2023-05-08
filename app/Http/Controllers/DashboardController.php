<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use DateTime;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600)));
//        $today = date("Y-m-d H:i:s", (strtotime('today')+((60*60*4))));
////        dd($today);
//        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')+((60*60*4))));
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')+(4.5*3600)));
////dd($today,$tomorrow);
///
///
//        $today = date("Y-m-d H:i:s",(Verta::today())->timestamp+((60*60*4)+(60*30)));
//        $tomorrow = date("Y-m-d H:i:s",(Verta::tomorrow())->timestamp+((60*60*4)+(60*30)));
//        dd((Verta::today())->timestamp);
//dd(date("Y-m-d H:i:s", (strtotime('today')+(4.5*3600))));
//        dd((verta()->toCarbon())::today()->timestamp);
//        dd(strtotime('tomorrow'),(Verta::tomorrow())->timestamp);
        $appointments= new Appointment;
        $datetime = new DateTime('tomorrow');
//        $now = date("Y-m-d H:i:s", (strtotime('now')-(60*60*1)));//1402
//        $today = date("Y-m-d H:i:s", (strtotime('today')));
//        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')));
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
