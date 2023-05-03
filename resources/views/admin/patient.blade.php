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
                    <a href="{{route("patients")}}" class="btn_visit">مشاهده نوبت ها</a>
                    <a href="{{route("patients")}}" class="btn_prep">مشاهده مشاهده نسخه ها</a>
                    <a href="{{route("patients")}}" class="btn_result">مشاهده مشاهده تست ها و آزمایشات</a>
                </div>
                <div class="back-box">
                    <a href="{{route("patients")}}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
