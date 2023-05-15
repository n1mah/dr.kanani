<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Patient;
use App\Models\Report;
use App\Models\ReportImage;
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
            'patients'=>$patients->all(),
            'back'=>redirect()->back()->getTargetUrl()
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
        $patient_id=null;if(request("patient")){$patient_id=request("patient");}
        $patients=new Patient;
        return view('admin.reports.add',[
            'patients'=>$patients->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'back'=>redirect()->back()->getTargetUrl(),
            'patient_id'=>$patient_id
        ]);
    }

    public function store(StoreReportRequest $request): RedirectResponse|View
    {
        $files= request()->file("images");
        try {
            $report=Report::make($request->all());
            $report->save();
            $reportImageController= new ReportImageController();
            $reportImageController->store($files,$report->id);
            $patient=$report->patient;
        }catch (\Exception){
            $patients=new Patient;
            return view('admin.reports.add',[
                'patients'=>$patients->all(),
                'back'=>redirect()->back()->getTargetUrl()
            ]);
        }
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
        return redirect()->route('reports');
    }
    public function edit_image(Report $report): RedirectResponse | View
    {
        return view('admin.reports.edit-images',[
            'report'=>$report,
        ]);
    }
    public function delete_image(ReportImage $reportImage)
    {

        $report=$reportImage->report;
        $reportImage->delete();
        return redirect()->route('report.image',$report);
    }
    public function store_image(Request $request,Report $report): RedirectResponse|View
    {
        $files= $request->file("images");
        try {
            $reportImageController= new ReportImageController();
            $reportImageController->store($files,$report->id);
            $patient=$report->patient;
        }catch (\Exception){
            $patients=new Patient;
            return view('admin.reports.edit-images',[
                'report'=>$report,
                'patients'=>$patients->all(),
                'back'=>redirect()->back()->getTargetUrl()
            ]);
        }
        return view('admin.reports.edit-images',[
            'report'=>$report,
        ]);
    }
}
