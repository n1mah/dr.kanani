<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-prescription-page">
                <h1> مشاهده جزییات  نسخه </h1>
                <br>
                <div class="box-btn">
                    <form action="{{route("prescription.edit_special",$prescription)}}" method="get">
                        @csrf
                        <button type="submit" class="btn_up">ویرایش</button>
                    </form>
                    <form action="{{route("prescription.delete",$prescription)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn_del">حذف</button>
                    </form>
                </div>
                <br>
                <form>
                    @csrf
                    <br>
                    <div>
                        <label for="name">بیمار</label>
                        <input type="text" disabled id="name" value="{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="visit">وقت انتخاب شده</label>
                        <input type="text" disabled id="visit" dir="ltr" value="{{$prescription->appointment->visitTimeGetter}}">
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع ویزیت</label>
                        <input type="text" disabled id="type" value="{{$prescription->appointment->type}}">
                    </div>
                    <br>
                    <div>
                        <label for="reason">علت مراجعه</label>
                        <textarea id="reason" disabled name="text_prescription" rows="3">{{$prescription->reason}}</textarea>
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">نسخه</label>
                        <textarea id="text_prescription" disabled name="text_prescription" rows="2">{{$prescription->text_prescription}}</textarea>
                    </div>
                    <br>
                    @if(count($prescription->images)>0)
                    <div class="splitter"></div>
                            <div class="show-images">
                                <h3>تصاویر نسخه ها</h3>
                                <p>برای مشاهده دقیق تر هرکدام از تصاویر بر روی آن کلیک کنید</p>
                                <br>
                                <div class="parent-box">
                                    @foreach($prescription->images as $image)
                                        <a href="{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}" target="_blank"><img src="{{asset("images/prescriptions/$image->image_path")}}" width="300px" alt="prescription-{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}"></a>
                                    @endforeach
                                </div>
                            </div>
                    <br>
                    @else
                        <p id="not-pic">برای این نسخه تصویری وجود ندارد</p>
                    @endif
                </form>
                <br>
                <div class="btn-box">
                    <a href="{{route("prescription.reports",$prescription)}}" class="btn_result">مشاهده مشاهده تست ها و آزمایشات</a>
                </div>
                <div class="back-box"><a href="{{$back}}">بازگشت به نسخه ها</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
