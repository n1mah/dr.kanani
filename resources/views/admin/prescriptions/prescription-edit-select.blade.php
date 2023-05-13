<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-special-prescription-page">
                <h1> ویرایش نسخه </h1>
                <br>
                <p>لطفا موردی را که میخواهید ویرایش کنید انتخاب کنید</p>
                <br>
                <div class="btn-group">
                    <a href="{{route("prescription.edit_special_1",$prescription)}}">ویرایش کاربر ( و نوبت )</a>
                    <a href="{{route("prescription.edit_special_2",$prescription)}}">ویرایش نوبت</a>
                    <a href="{{route("prescription.edit_special_3",$prescription)}}">ویرایش اطلاعات نسخه</a>
                </div>
                <form action="">
                    @csrf
                    <br>
                    <div>
                        <label for="name">بیمار</label>
                        <input type="text" disabled id="name" value="{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="visit">وقت (نوبت) انتخاب شده</label>
                        <input type="text" disabled id="visit" value="{{$prescription->appointment->visit_time}}">
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع ویزیت</label>
                        <input type="text" disabled id="type" value="{{$prescription->type}}">
                    </div>
                    <br>
                    <div>
                        <label for="reason">علت مراجعه</label>
                        <textarea id="reason" disabled name="text_prescription" rows="6">{{$prescription->reason}}</textarea>
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">نسخه</label>
                        <textarea id="text_prescription" disabled name="text_prescription" rows="6">{{$prescription->text_prescription}}</textarea>
                    </div>
                    <br>
                    <br>
                </form>

                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت به نسخه ها</a>
                </div>

            </div>
        </div>
    </div>

<x-panel.layouts.footer />
