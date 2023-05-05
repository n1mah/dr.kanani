<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Patient;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $reports= new Report;
        return view('admin.reports',[
            'reports'=>$reports->orderBy("updated_at","desc")->paginate(15)
        ]);
    }
    public function create():View
    {
        $patients=new Patient;
        return view('admin.report-add',[
            'patients'=>$patients->all()
        ]);
    }
    public function store(StoreReportRequest $request)
    {
        $report=Report::create($request->all());
        $patient=$report->patient;

        return redirect()
            ->route('report.addForm2',[
                'patient'=>$patient,
                'report'=>$report
            ]);
    }
    public function create2(Report $report ,Patient $patient):View
    {
        return view('admin.report-add-prescription',[
            'prescriptions'=>$patient->prescriptions,
            'report'=>$report
        ]);
    }
    public function update_prescription(UpdateReportRequest $request,Report $report)
    {
        $report->update($request->all());
        return redirect()
            ->route('reports');
    }
    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        return redirect()->back();
    }
}
