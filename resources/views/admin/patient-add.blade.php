<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-patient-page">
                <h1>افزودن بیمار جدید</h1>

                <br>
                <form action="{{route("patient.store")}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="national_code">کدملی <span class="star-red">*</span></label>
                        <input type="number" id="national_code" name="national_code">
                    </div>
                    <br>
                    <div>
                        <label for="fName">نام<span class="star-red">*</span></label>
                        <input type="text" id="fName" name="firstname">
                    </div>
                    <br>
                    <div>
                    <label for="lName">نام خانوادگی<span class="star-red">*</span></label>
                    <input type="text" id="lName" name="lastname">
                    </div>
                    <br>
                    <div>
                    <label>تولد<span class="star-red">*</span></label>
                        <div>
                            <label for="year">سال</label>
                            <select id="year" name="year">
                                @for($i = 1300; $i <= 1402; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="month">ماه</label>
                            <select id="month" name="month">
                                @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="day">روز</label>
                            <select id="day" name="day">
                                @for($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>
                    <div>
                    <label for="insurance">نوع بیمه<span class="star-red">*</span></label>
                        <select id="insurance" name="insurance_id">
                            @foreach($insurances as $insurance)
                            <option value="{{$insurance->id}}">{{$insurance->title}}</option>
                            @endforeach

                        </select>

                    </div>
                    <br>
                    <div>
                    <label for="mobile">موبایل<span class="star-red">*</span></label>
                    <input type="number" id="mobile" name="mobile">
                    </div>
                    <br>
                    <div>
                    <label for="phone">تلفن ثابت</label>
                    <input type="number" id="phone" name="phone">
                    </div>
                    <br>
                    <input class="btn" type="submit" value="افزودن">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("patients")}}">بازگشت</a>
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
