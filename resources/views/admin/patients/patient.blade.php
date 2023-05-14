<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-patient-page">
                <h1>مشاهده بیمار</h1>
                <br>
                <form>
                    @csrf
                    <div>
                        <label for="national_code">کدملی </label>
                        <input type="number" disabled id="national_code" name="national_code" value="{{$patient->national_code}}">
                    </div>

                    <br>
                    <div>
                        <label for="fName">نام</label>
                        <input type="text" disabled id="fName" name="firstname" value="{{$patient->firstname}}">
                    </div>
                    <br>
                    <div>
                        <label for="lName">نام خانوادگی</label>
                        <input type="text" disabled id="lName" name="lastname" value="{{$patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="birth">تولد</label>
                        <input type="text" disabled id="birth" name="birth" value="{{$patient->year}}/{{$patient->month}}/{{$patient->day}}">
                    </div>
                    <br>
                    <div>
                        <label for="insurance">نوع بیمه</label>
                        <input type="text" disabled id="insurance" name="insurance" value="{{$patient->insurance->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="mobile">موبایل</label>
                        <input type="number" disabled id="mobile" name="mobile" value="{{$patient->mobile}}">
                    </div>
                    <br>
                    <div>
                        <label for="phone">تلفن ثابت</label>
                        <input type="number" disabled id="phone" name="phone" value="{{$patient->phone}}">
                    </div>
                    <br>
                </form>
                <br>
                <div class="btn-box">
                    <a href="{{route("patient.appointments",$patient)}}" @if(count($patient->appointments)<1) onclick="alert('نوبتی وجود ندارد');return false;" @endif class="btn_visit">مشاهده نوبت ها</a>
                    <a href="{{route("patient.prescriptions",$patient)}}" @if(count($patient->prescriptions)<1) onclick="alert('نسخه ای وجود ندارد');return false;" @endif class="btn_prep">مشاهده نسخه ها</a>
                    <a href="{{route("patient.reports",$patient)}}" @if(count($patient->reports)<1) onclick="alert('تست و آزمایش ندارد');return false;" @endif class="btn_result">مشاهده تست ها و آزمایشات</a>
                    <a href="{{route("financials.patient",$patient)}}" @if(count($patient->financialTransactions)<1) onclick="alert('پرداختی ندارد');return false;" @endif class="btn_financial">مشاهده پرداختی ها</a>
                </div>
                <div class="back-box">
                    <a href="{{route("patients")}}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
