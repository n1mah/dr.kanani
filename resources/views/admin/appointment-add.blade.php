<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-appointment-page">
                <h1>افزودن وقت جدید</h1>
                <br>
                <form action="{{route("appointment.store")}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="patient">بیمار<span class="star-red">*</span></label>
                        <select id="patient" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}">{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع <span class="star-red">*</span></label>
                        <select id="type" name="type">
                            <option value="ویزیت">ویزیت</option>
                            <option value="بررسی آزمایش یا تست">بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="visit_time">زمان ویزیت<span class="star-red">*</span></label>
                        <input type="number" id="visit_time" name="visit_time" value="{{time()}}">
                    </div>
                    <br>
                    <div>
                    <label for="description">توضیح</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="افزودن">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("appointments")}}">بازگشت</a>
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
