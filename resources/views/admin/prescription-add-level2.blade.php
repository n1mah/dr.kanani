<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-prescription-page">
                <h1>افزودن نسخه جدید<span> ( مرحله ۲ از ۳ ) </span></h1>
                <br>
                <p>نوبت بیمار مورد نظر را انتخاب کنید</p>
                <p> درصورت نداشتن وقت قبلی , گزینه <span> بدون نوبت </span>  را انتخاب کنید</p>
                <form action="{{route("prescription.store",$patient)}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="appointment_id">وقت (نوبت)<span class="star-red">*</span></label>
                        <select id="appointment_id" name="appointment_id">
                            <option value="">بدون نوبت</option>
                            @foreach($appointments as $appointment)
                                <option value="{{$appointment->id}}">{{$appointment->visit_time}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="reason">دلیل مراجعه<span class="star-red">*</span></label>
                        <textarea id="reason" name="reason" rows="6"></textarea>
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع مراجعه <span class="star-red">*</span></label>
                        <select id="type" name="type">
                            <option value="ویزیت">ویزیت</option>
                            <option value="بررسی آزمایش یا تست">بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="انتخاب نوبت , دلیل مراجعه و نوع مراجعه   - ادامه ">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("prescription.addForm1")}}">بازگشت به صفحه قبل</a>
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
