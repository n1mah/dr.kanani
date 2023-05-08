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
        $tomorrow = date("Y-m-d H:i:s", (strtotime('tomorrow')+(4.5*3600)));
        $appointments= new Appointment;
        $appointments_today_tomorrow= $appointments->whereBetween('visit_time',[$today,$tomorrow])->orderBy("visit_time","asc")->get();
        return view('admin.home',[
                'appointments'=>$appointments_today_tomorrow
            ]);
    }
}
