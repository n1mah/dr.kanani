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
                <p>  <span> نکته :  </span> نوبت های کنسل شده در لیست نوبت ها وجود ندارد </p>
                <form action="{{route("prescription.store",$patient)}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="appointment_id">وقت (نوبت)<span class="star-red">*</span></label>
                        <select id="appointment_id" name="appointment_id" dir="ltr">
                            <option value="">بدون نوبت</option>
                            @foreach($appointments as $appointment)
                                <option @isset($appointment_id) @if($appointment_id==$appointment->id) selected @endif @endisset value="{{$appointment->id}}">{{$appointment->visitTimeGetter}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="reason">دلیل مراجعه<span class="star-red">*</span></label>
                        <textarea id="reason" name="reason" rows="3"></textarea>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="انتخاب نوبت , دلیل مراجعه و نوع مراجعه   - ادامه ">
                </form>
                <br>
                <div class="back-box"><a href="{{route("prescription.addForm1")}}">بازگشت به صفحه قبل</a></div>
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
