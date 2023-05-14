<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-special-prescription-page">
                <h1> ویرایش نسخه </h1>
                <br>
                <p>بیمار مورد نظر خود را انتخاب کنید و سپس برای تکمیل ویرایش در مرحله بعدی وقت (نوبت) را تعیین کنید . درصورتی که نوبت مشخص نشود , ویرایش انجام نمی شود </p>
                <br>
                <div class="btn-back-group"><a href="{{route("prescription.edit_special",$prescription)}}">بازگشت به ویرایش</a></div>
                <br>
                @if($errors->any())
                    <div class="errorBox">
                        @foreach($errors->all() as $error)
                            <strong>- {{ $error }}</strong>
                        @endforeach
                    </div>
                @endif
                <br>
                <form action="{{route("prescription.edit_special_2",$prescription)}}" method="get">
                    @csrf
                    @method("get")
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient_item)
                                <option value="{{$patient_item->national_code}}" {{ $patient->national_code == $patient_item->national_code ? 'selected' : ''}}>{{$patient_item->firstname}} {{$patient_item->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="btn-group-single">
                        <input class="btn" type="submit" value="ویرایش بیمار">
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
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
