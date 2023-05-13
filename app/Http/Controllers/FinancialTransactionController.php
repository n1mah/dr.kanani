<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialTransactionRequest;
use App\Models\FinancialTransaction;
use App\Models\Patient;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinancialTransactionController extends Controller
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
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransactions= new FinancialTransaction();
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("id","desc")->paginate(10)
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
            ->orWhere('national_code', 'LIKE', '%'.$search.'%')
        ;
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("id","desc")->paginate(10)
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patient= new Patient;
        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        return view('admin.financial_transactions.add',[
            "methods"=>$methods,
            'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get()
        ]);
    }

    public function store(FinancialTransactionRequest $request): \Illuminate\Http\RedirectResponse
    {
        FinancialTransaction::create($request->all());
        return redirect()
            ->route('financials');
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
        return redirect()
            ->route('financials');
    }
    public function destroy(FinancialTransaction $financialTransaction): \Illuminate\Http\RedirectResponse
    {
        $financialTransaction->delete();
        return redirect()
            ->route('financials');
    }

    public function index_patient(Patient $patient): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $financialTransactions=$patient->financialTransactions()->orderBy("id","desc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions,
            'hasSearch'=>false
        ]);
    }
    public function today()
    {
        $financialTransaction= new FinancialTransaction;
        $today = $this->GetToday();
//        dd($today);
        $tomorrow = $this->GetTomorrow();
        $financialTransaction_today_tomorrow= $financialTransaction->whereBetween('created_at',[$today,$tomorrow])->orderBy("created_at","asc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransaction_today_tomorrow,
        ]);
    }
    public function last_7day()
    {
        $financialTransaction= new FinancialTransaction;
        $today = $this->GetToday();
//        dd($today);
        $tomorrow = $this->GetTomorrow();
        $financialTransaction_today_tomorrow= $financialTransaction->whereBetween('created_at',[$today,$tomorrow])->orderBy("created_at","asc")->paginate(10);
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransaction_today_tomorrow,
        ]);
    }
}
