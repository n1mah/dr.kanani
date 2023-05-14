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
        return view('admin.reports.index',[
            'reports'=>$reports->orderBy("updated_at","desc")->paginate(15)
        ]);
    }

    public function show(Report $report): View
    {
        return view('admin.reports.show',[
            'report'=>$report,
        ]);
    }

    public function edit(Report $report): View
    {
        $patients=new Patient;
        return view('admin.reports.edit-report',[
            'report'=>$report,
            'patients'=>$patients->all()
        ]);
    }

    public function edit_special(Report $report): View
    {
        return view('admin.reports.edit-select',[
            'report'=>$report,
        ]);
    }

    public function update(StoreReportRequest $request,Report $report): RedirectResponse
    {
        $report->update($request->all());
        $patient=$report->patient;
        return redirect()->route('report.addForm2',[
            'patient'=>$patient,
            'report'=>$report
        ]);
    }

    public function create():View
    {
        $patients=new Patient;
        return view('admin.reports.add',[
            'patients'=>$patients->all()
        ]);
    }

    public function store(StoreReportRequest $request): RedirectResponse
    {
        $report=Report::create($request->all());
        $patient=$report->patient;
        return redirect()
            ->route('report.addForm2',[
                'patient'=>$patient,
                'report'=>$report
            ]);
    }

    public function create2(Patient $patient,Report $report):View
    {
        return view('admin.reports.add-prescription',[
            'prescriptions'=>$patient->prescriptions,
            'report'=>$report
        ]);
    }

    public function update_prescription(UpdateReportRequest $request,Report $report): RedirectResponse
    {
        $report->update($request->all());
        return redirect()->route('reports');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        return redirect()->back();
    }
}
