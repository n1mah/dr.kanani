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
                <div class="btn-back-group">
                    <a href="{{route("prescription.edit_special",$prescription)}}">بازگشت به ویرایش</a>
                </div>
                <br>
                @if($errors->any())
                    <div class="errorBox">
                        @foreach($errors->all() as $error)
                            <strong>- {{ $error }}</strong>
                        @endforeach
                    </div>
                @endif
                <br>
                <form action="{{route("prescription.update_special_3",$prescription)}}" method="post">
                    @csrf
                    @method("post")
                    <br>
                    <div>
                        <label for="name">بیمار</label>
                        <input type="text" disabled id="name" value="{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="visit">وقت (نوبت) انتخاب شده</label>
                        <input type="text" disabled id="visit" dir="ltr" value="{{$prescription->appointment->visitTimeGetter}}">
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع مراجعه <span class="star-red">*</span></label>
                        <select id="type" name="type">
                            <option value="ویزیت" {{ $prescription->type == "ویزیت" ? 'selected' : ''}}>ویزیت</option>
                            <option value="بررسی آزمایش یا تست" {{ $prescription->type == "بررسی آزمایش یا تست" ? 'selected' : ''}}>بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="reason">علت مراجعه</label>
                        <textarea id="reason" name="reason" rows="6">{{$prescription->reason}}</textarea>
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">نسخه</label>
                        <textarea id="text_prescription" name="text_prescription" rows="6">{{$prescription->text_prescription}}</textarea>
                    </div>
                    <br>
                    <div class="btn-group-single">
                        <input class="btn" type="submit" value="ویرایش اطلاعات نسخه">
                    </div>
                    <br>
                    <br>
                </form>

                <br>


            </div>
        </div>
    </div>

<x-panel.layouts.footer />
