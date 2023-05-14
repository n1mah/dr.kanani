<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-special-prescription-page">
                <h1> ویرایش نسخه </h1>
                <br>
                <p>نوبت مورد نظر خود را وارد کنید</p>
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
                <form action="{{route("prescription.update_special_2",[$prescription,$patient_id])}}" method="post">
                    @csrf
                    @method("post")
                    <div>
                        <label for="name">بیمار</label>
                        <input type="text" disabled id="name" value="{{$patient->firstname}} {{$patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="appointment_id">وقت (نوبت)<span class="star-red">*</span></label>
                        <select id="appointment_id" name="appointment_id">
                            <option value="">بدون نوبت</option>
                            @foreach($appointments as $appointment_item)
                                <option value="{{$appointment_item->id}}" {{ $appointment_item->id == $appointment->id ? 'selected' : ''}}>{{$appointment_item->visitTimeGetter}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="btn-group-single">
                        <input class="btn" type="submit" value="ویرایش نوبت بیمار">
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
