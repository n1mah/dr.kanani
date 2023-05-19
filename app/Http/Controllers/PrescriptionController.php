<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Models\Appointment;
use App\Models\Image;
use App\Models\Patient;
use App\Models\Prescription;
//use http\Env\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class PrescriptionController extends Controller
{
    public function index():View
    {
        $prescriptions= new Prescription;
        return view('admin.prescriptions.index',[
            'prescriptions'=>$prescriptions->orderBy("updated_at","desc")->paginate(15)
        ]);
    }

    public function create():View
    {
        $patient_id=null;if(request("patient")){$patient_id=request("patient");}
        $patients=new Patient();
        return view('admin.prescriptions.add-level1',[
            'patients'=>$patients->where("is_active",true)->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
            'back'=>redirect()->back()->getTargetUrl(),
            'patient_id'=>$patient_id
        ]);
    }

    public function create2(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $patient_id=request("patient_id");
        $patient=new Patient();
        try {
            $patientN=$patient->findOrFail($patient_id)->where('national_code', $patient_id)->get()->first();
        }catch(\Exception $exception){
          return  redirect()->back()->withErrors(['patient_err' => ['لطفا بیمار را از لیست بیماران انتخاب کنید (نامعتبر)']]);
        }
        $appointment=new Appointment();
        return view('admin.prescriptions.add-level2',[
            'appointments'=>$appointment->where("patient_id",$patient_id)->whereIn("status",[0,1])->orderby("visit_time")->get(),
            'patient'=>$patientN
        ]);
    }

    public function create2_error(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $patients=new Patient();
        return view('admin.prescriptions.add-level1',[
            'patients'=>$patients->where("is_active",true)->get(),
            'back'=>redirect()->route("prescriptions")
        ]);
    }

    public function store(Patient $patient,StorePrescriptionRequest $request)
    {
        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        $validated = $request->all();
        $appointment_id=$validated["appointment_id"];
        if ($appointment_id==="" || is_null($appointment_id)){
            $appointmentN = new Appointment;
            $appointmentN->patient_id =$patient->national_code;
            $appointmentN->descriptions =$validated["reason"];
            $appointmentN->type = "نامشخص";
            $appointmentN->visit_time =time()*1000;
            $appointmentN->save();
//            (new AppointmentController)->success_work($appointmentN);

                $patient_id=$patient->national_code;
                $patient= new Patient;
                $appointment_id=$appointmentN->id;
                $prescription= Prescription::create([...$validated,'appointment_id'=>$appointment_id]);
            return view('admin.financial_transactions.add',[
                    "methods"=>$methods,
                    'appointment'=>$appointmentN,
                    'patient'=>$appointmentN->patient,
                    'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
                    'patient_id'=>$patient_id,
                    'visit'=>'yes',
                    'title_h1'=>' تایید ویزیت و ثبت پرداخت و (مرحله بعد آپلود تصاویر نسخه و توضیح آن)',
                    'prescription'=>$prescription->id,
                    'next'=>[
                        'route'=>'admin.prescriptions.add-level3',
                    ]
                ]);
        }else{
            $appointment=Appointment::findOrFail($appointment_id);
            if($appointment->status==1){
                $prescription= Prescription::create($validated);
                return view('admin.prescriptions.add-level3',[
                    'prescription'=>$prescription,
                ]);
            }elseif ($appointment->status==0){
//                (new AppointmentController)->success_work($appointment);
                $prescription= Prescription::create($validated);
                return view('admin.financial_transactions.add',[
                    "methods"=>$methods,
                    'appointment'=>$appointment,
                    'patient'=>$appointment->patient,
                    'patients'=>$patient->orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
                    'patient_id'=>$appointment->patient->national_code,
                    'visit'=>'yes',
                    'title_h1'=>' تایید ویزیت و ثبت پرداخت و (مرحله بعد آپلود تصاویر نسخه و توضیح آن)',
                    'prescription'=>$prescription->id,
                    'next'=>[
                        'route'=>'admin.prescriptions.add-level3',
                    ]
                ]);
            }else{ // cancel // !valid
                return redirect()->route('appointments');

            }

        }
    }

    public function edit(Prescription $prescription)
    {
        return view('admin.prescriptions.add-level3',[
            'prescription'=>$prescription,
        ]);
    }

    public function update(Request $request,Prescription $prescription):View|RedirectResponse
    {
        $files= request()->file("images");
        $imageController= new ImageController;
        $imageController->store($files,$prescription->id);
        if (!is_null(request("text_prescription"))){
            $prescription->text_prescription=request("text_prescription");
            $prescription->save();
        }
        return redirect()->route('prescription.show',$prescription);
    }

    public function show(Prescription $prescription): View
    {
        return view('admin.prescriptions.show',[
            'prescription'=>$prescription,
            'back'=>route('prescriptions')
        ]);
    }

    public function edit_special(Prescription $prescription): View
    {
        return view('admin.prescriptions.edit-select',[
            'prescription'=>$prescription,
            'back'=>redirect()->back()->getTargetUrl()
        ]);
    }

    public function edit_special_1(Prescription $prescription): View
    {
        $patients=new Patient();
        return view('admin.prescriptions.edit-select-1',[
            'prescription'=>$prescription,
            'patient'=>$prescription->appointment->patient,
            'patients'=>$patients->where("is_active",true)->get(),
        ]);
    }

    public function edit_special_2(Prescription $prescription): RedirectResponse | View
    {
        $appointment=new Appointment();
            $patient_id=
            is_null(request("patient_id"))?
            $prescription->appointment->patient->national_code:
            request("patient_id");
        try {
            $patientN=Patient::findOrFail($patient_id)->where("is_active",true)->where('national_code', $patient_id)->get()->first();
        }catch(\Exception $exception){
            return  redirect()->back()->withErrors(['patient_err' => ['لطفا بیمار را از لیست بیماران انتخاب کنید (نامعتبر)']]);
        }
//        $appointment=$appointment->where("patient_id",$patient_id)->whereIn("status",[0,1])->orderby("visit_time")->get();
        return view('admin.prescriptions.edit-select-2',[
            'prescription'=>$prescription,
            'patient_id'=>$patient_id,
            'patient'=>$patientN,
            'appointments'=>$appointment->where("patient_id",$patient_id)->whereIn("status",[0,1])->orderby("visit_time")->get(),
            'appointment'=>$prescription->appointment
        ]);
    }

    public function edit_image(Prescription $prescription): RedirectResponse | View
    {
        return view('admin.prescriptions.edit-images',[
            'prescription'=>$prescription,
            'appointment'=>$prescription->appointment
        ]);
    }

    public function edit_special_2_process(Prescription $prescription,$patient_id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {

        $methods = [ "دستگاه کارتخوان" , "کارت به کارت", "نقدی" , "چندحالتی" , "غیره"];
        $appointment_id=request("appointment_id");
        if ($appointment_id==="" || is_null($appointment_id)){
            try {
                Patient::findOrFail($patient_id)->where('national_code', $patient_id)->get()->first();
            }catch(\Exception $exception){
                return  redirect()->route("prescription.edit_special",$prescription)->withErrors(['patient_err' => ['لطفا بیمار را از لیست بیماران انتخاب کنید (نامعتبر)']]);
            }

            $appointmentN = new Appointment;
            $appointmentN->patient_id =$patient_id;
            $appointmentN->descriptions =$prescription->reason;
            $appointmentN->type = "نامشخص";
            $appointmentN->visit_time =time()*1000;
            $appointmentN->save();


            $appointment_id=$appointmentN->id;
            $prescription->appointment_id=$appointment_id;
            $prescription->save();

            return view('admin.financial_transactions.add',[
                "methods"=>$methods,
                'appointment'=>$appointmentN,
                'patient'=>$appointmentN->patient,
                'patients'=>Patient::orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
                'patient_id'=>$patient_id,
                'visit'=>'yes',
                'title_h1'=>' تایید ویزیت و ثبت پرداخت و (مرحله بعد آپلود تصاویر نسخه و توضیح آن)',
                'prescription'=>$prescription->id,
                'next'=>[
                    'route'=>'admin.prescriptions.show',
                ]
            ]);

        }else{
            try {
                $appointment =Appointment::findOrFail($appointment_id);
            }catch(\Exception $exception){
                return  redirect()->back()->withErrors(['appointment_err' => [' لطفا نوبت را از لیست انتخاب کنید (نامعتبر) یا بدون نوبت قرار دهید']]);
            }
        }
        if($appointment->status==1) {
            $prescription->appointment_id=$appointment_id;
            $prescription->save();
            return view('admin.prescriptions.edit-select',[
                'prescription'=>$prescription,
                'back'=>redirect()->back()->getTargetUrl()
            ]);
        }elseif ($appointment->status==0){
            $prescription->appointment_id=$appointment->id;
            $prescription->save();
            return view('admin.financial_transactions.add',[
                "methods"=>$methods,
                'appointment'=>$appointment,
                'patient'=>$appointment->patient,
                'patients'=>Patient::orderBy("firstname","asc")->orderBy("lastname","asc")->get(),
                'patient_id'=>$patient_id,
                'visit'=>'yes',
                'title_h1'=>' تایید ویزیت و ثبت پرداخت و (مرحله بعد آپلود تصاویر نسخه و توضیح آن)',
                'prescription'=>$prescription->id,
                'next'=>[
                    'route'=>'admin.prescriptions.show',
                ]
            ]);
        }elseif ($appointment->status==2){
            return  redirect()->route("appointments");
        }
    }

    public function edit_special_3(Prescription $prescription): View
    {
        return view('admin.prescriptions.edit-select-3',[
            'prescription'=>$prescription,
        ]);
    }

    public function edit_special_3_process(UpdatePrescriptionRequest $request,Prescription $prescription)
    {
        $validated = $request->validated();
        $prescription->update($validated);
        return redirect()->route('prescription.edit_special',['prescription'=>$prescription]);
    }

    public function destroy(Prescription $prescription): RedirectResponse
    {
        $prescription->delete();
        return redirect()->route('prescriptions');
    }

    public function show_reports(Prescription $prescription):View
    {
        $patient_id=null;if(request("id")){$patient_id=request("id");}
        $reports=$prescription->reports()->orderBy("updated_at","desc")->paginate(10);
        $patient=$prescription->appointment->patient;
        return view('admin.prescriptions.reports',[
            'reports'=>$reports,
            'prescription'=>$prescription,
            'patient'=>$patient,
            'back'=>redirect()->back()->getTargetUrl(),
            'patient_id_add'=>$patient_id
        ]);
    }

    public function delete_image(Prescription $prescription ,Image $image): RedirectResponse
    {
        $image->delete();
        return redirect()->back();
    }
}
