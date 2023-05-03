<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-appointment-page">
                <h1>ویرایش وقت ویزیت</h1>
                <br>
                <form action="{{route("appointment.update",$appointment)}}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}" {{ $patient->national_code == $appointment->patient_id ? 'selected' : '' }}>{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع <span class="star-red">*</span></label>
                        <select id="type" name="type">
                            <option value="ویزیت" {{ $appointment->type == "ویزیت" ? 'selected' : '' }}>ویزیت</option>
                            <option value="بررسی آزمایش یا تست" {{ $appointment->type == "بررسی آزمایش یا تست" ? 'selected' : '' }}>بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="visit_time">زمان ویزیت<span class="star-red">*</span></label>
                        <input type="number" id="visit_time" name="visit_time" value="{{ $appointment->visit_time }}">
                    </div>
                    <br>
                    <div>
                        <label for="description">توضیح</label>
                        <textarea id="description" name="descriptions">{{ $appointment->descriptions }}</textarea>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a>
                </div>
                @if($errors->any())
                <div class="errorBox">
                    @foreach($errors->all() as $error)
                        <strong>- {{ $error }}</strong>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
