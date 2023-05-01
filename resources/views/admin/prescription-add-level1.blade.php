<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-prescription-page">
                <h1>افزودن نسخه جدید</h1>
                <br>
                <p>بیمار مورد نظر را انتخاب کنید</p>
                <form action="{{route("prescription.addForm2")}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}">{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <input class="btn" type="submit" value="انتخاب بیمار برای ثبت نسخه">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("prescriptions")}}">بازگشت</a>
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
