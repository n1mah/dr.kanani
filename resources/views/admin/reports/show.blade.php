<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-report-page">
                <h1> مشاهده گزارش / آزمایش  </h1>
                <br>
                <div class="box-btn">
                    <form action="{{route("report.edit_special",$report)}}" method="get">
                        @csrf
                        <button type="submit" class="btn_up">ویرایش</button>
                    </form>
                    <form action="{{route("report.delete",$report)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn_del">حذف</button>
                    </form>
                </div>
                <br>
                <form>
                    <br>
                    <div>
                        <label for="patient_id">بیمار</label>
                        <select disabled id="patient_id" name="patient_id">
                            <option>{{$report->patient->firstname}} {{$report->patient->lastname}}</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="patient_id">نسخه</label>
                        <select disabled id="patient_id" name="patient_id">
                            <option>
                                @if(isset($report->prescription->id))
                                    {{$report->prescription->id}}-{{$report->prescription->reason}}
                                @else
                                    نسخه ندارد
                                @endif
                            </option>
                        </select>
                    </div>
                    <br>

                    <div>
                        <label for="title">عنوان</label>
                        <input disabled id="title" name="title" value="{{$report->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="content">محتوا گزارش</label>
                        <textarea disabled id="content" name="content" rows="3">{{$report->content}}</textarea>
                    </div>
                    <br>
                    <br>
                    <div class="show-images">
                        <h3>تصاویر گزارش /آزمایش</h3>
                        <p>برای مشاهده دقیق تر هرکدام از تصاویر بر روی آن کلیک کنید</p>
                        <br>
                        <div class="parent-box">
                            @foreach($report->report_images as $image)
                                <a href="{{asset("images/reports/$image->image_path")}}" title="report-{{asset("images/reports/$image->image_path")}}" target="_blank"><img src="{{asset("images/reports/$image->image_path")}}" width="300px" alt="report-{{asset("images/reports/$image->image_path")}}" title="report-{{asset("images/reports/$image->image_path")}}"></a>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    @if(isset($report->prescription->id))
                        <hr>
                        <br>
                        <h3>نسخه</h3>
                        <br>
                        <div>
                            <label for="content">دلیل مراجعه</label>
                            <textarea disabled id="content" name="content" rows="۲">{{$report->prescription->reason}}</textarea>
                        </div>
                        <br>
                        <div>
                            <label for="content">متن نسخه</label>
                            <textarea disabled id="content" name="content" rows="3">{{$report->prescription->text_prescription}}</textarea>
                        </div>
                        <br>
                        <div>
                            <label for="appointment"> ویزیت</label>
                            <input type="text" dir="ltr" disabled id="appointment" value="{{$report->prescription->appointment->visitTimeGetter}}">
                        </div>
                        <br>
                        <div class="show-images">
                            <h3>تصاویر نسخه ها</h3>
                            <div class="parent-box parent-box-prescription">
                                @foreach($report->prescription->images as $image)
                                    <a href="{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}" target="_blank"><img src="{{asset("images/prescriptions/$image->image_path")}}" width="150px" alt="prescription-{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}"></a>
                                @endforeach
                            </div>
                            <br>
                        </div>
                        <br>
                    @endif
                    <br>

                </form>



                <br>
                <div class="back-box"><a href="{{route("reports")}}">بازگشت به نسخه ها</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
