<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialTransactionRequest;
use App\Models\FinancialTransaction;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinancialTransactionController extends Controller
{
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
}
