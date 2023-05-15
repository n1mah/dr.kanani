<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialTransactionRequest;
use App\Models\Appointment;
use App\Models\FinancialTransaction;
use App\Models\Patient;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinancialTransactionController extends Controller
{
    public $timeAdded=(3600*(4.5)); //4.5*3600
    public function GetToday(): string
    {
        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->timestamp)+$this->timeAdded));
    }
    public function GetTomorrow(): string
    {
        return date("Y-m-d H:i:s", ((Verta::tomorrow("Asia/Tehran")->timestamp)+$this->timeAdded));
    }
    public function GetAddDay($day): string
    {
        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->addDays($day)->timestamp)+$this->timeAdded));
    }
    public function GetSubDay($day): string
    {
        return date("Y-m-d H:i:s", ((Verta::today("Asia/Tehran")->subDays($day)->timestamp)+$this->timeAdded));
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransactions= new FinancialTransaction();
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("id","desc")->paginate(10)
        ]);
    }

    public function index_ordered_time(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransactions= new FinancialTransaction();
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("created_at","asc")->paginate(10)
        ]);
    }

    public function search(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search=request("search");
        $financialTransactions= FinancialTransaction::join('patients', 'patients.national_code', '=', 'financial_transactions.patient_id')
            ->where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('patients.firstname', 'LIKE', '%'.$search.'%')
            ->orWhere('patients.lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('method', 'LIKE', '%'.$search.'%')
            ->orWhere('national_code', 'LIKE', '%'.$search.'%');
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("id","desc")->get(),
            'search'=>'has'
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient_id=null;if(request("patient")){$patient_id=request("patient");}
        $patient= new Patient;
        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        return view('admin.financial_transactions.add',[
            "methods"=>$methods,
            'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'patient_id'=>$patient_id,
            'title_h1'=>'ثبت پرداختی'
        ]);
    }

    public function store(FinancialTransactionRequest $request)
    {
        FinancialTransaction::create($request->all());
        if ($request->input("appointment_id") !== null){
            $appointment_id=$request->input("appointment_id");
            $appointment=Appointment::findOrFail($appointment_id);
            (new AppointmentController)->success_work($appointment);
//            return redirect()->route('financials');
            $patientN=$appointment->patient;
            $patient_id=$appointment->patient->national_code;
            $appointment=new Appointment();
            return view('admin.prescriptions.add-level2',[
                'appointments'=>$appointment->where("patient_id",$patient_id)->whereIn("status",[0,1])->orderby("visit_time")->get(),
                'patient'=>$patientN,
                'appointment_id'=>$appointment_id,
            ]);
        }else{
            return redirect()->route('financials');
        }
    }

    public function show(FinancialTransaction $financialTransaction): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.financial_transactions.show',[
            'financialTransaction'=>$financialTransaction,
        ]);
    }

    public function edit(FinancialTransaction $financialTransaction): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient= new Patient;
        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        return view('admin.financial_transactions.edit',[
            "methods"=>$methods,
            'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'financialTransaction'=>$financialTransaction,
        ]);
    }

    public function update(FinancialTransactionRequest $request,FinancialTransaction $financialTransaction): \Illuminate\Http\RedirectResponse
    {
        $financialTransaction->update($request->all());
        return redirect()->route('financials');
    }

    public function destroy(FinancialTransaction $financialTransaction): \Illuminate\Http\RedirectResponse
    {
        $financialTransaction->delete();
        return redirect()->route('financials');
    }

    public function index_patient(Patient $patient): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient_id=null;if(request("id")){$patient_id=request("id");}
        $financialTransactions=$patient->financialTransactions()->orderBy("id","desc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions,
            'hasSearch'=>false,
            'patient_id_add'=>$patient_id
        ]);
    }

    public function index_appointment(Appointment $appointment): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient_id=null;if(request("id")){$patient_id=request("id");}
        $financialTransactions=$appointment->financialTransactions()->orderBy("id","desc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions,
            'hasSearch'=>false,
            'appointment'=>true,
            'patient_id_add'=>$patient_id
        ]);
    }

    public function today(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransaction= new FinancialTransaction;
        $today = $this->GetToday();
        $tomorrow = $this->GetTomorrow();
        $financialTransaction_today_tomorrow= $financialTransaction->whereBetween('created_at',[$today,$tomorrow])->orderBy("created_at","asc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransaction_today_tomorrow,
        ]);
    }

    public function last_7day(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransaction= new FinancialTransaction;
        $today = $this->GetToday();
        $last_7day = $this->GetSubDay("7");
        $financialTransaction_last_7_days= $financialTransaction->whereBetween('created_at',[$last_7day,$today])->orderBy("created_at","asc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransaction_last_7_days,
        ]);
    }

    public function last_30day(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransaction= new FinancialTransaction;
        $today = $this->GetToday();
        $last_30day = $this->GetSubDay("30");
        $financialTransaction_last_30_days= $financialTransaction->whereBetween('created_at',[$last_30day,$today])->orderBy("created_at","asc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransaction_last_30_days,
        ]);
    }
}
