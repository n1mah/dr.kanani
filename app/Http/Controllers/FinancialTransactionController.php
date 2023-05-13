<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FinancialTransactionController extends Controller
{
    public function index():View
    {
        $financialTransactions= new FinancialTransaction();
        return view('admin.financial_transactions.index',[
            'financialTransactions'=>$financialTransactions->orderBy("id","desc")->paginate(10)
        ]);
    }
    public function search()
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
}
