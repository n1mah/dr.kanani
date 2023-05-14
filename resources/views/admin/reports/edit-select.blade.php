<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-special-report-page">
                <h1> ویرایش نسخه </h1>
                <br>
                <p>لطفا موردی را که میخواهید ویرایش کنید انتخاب کنید</p>
                <br>
                <div class="btn-group">
                    <a href="{{route("report.editForm",$report)}}">ویرایش جزییات گزارش <br> ( +ویرایش بیمار )</a>
                    <a href="{{route("report.addForm2",[$report->patient,$report])}}">ویرایش نسخه انتخابی <br>  (مربوط به گزارش )</a>
                    <a href="{{route("report.addForm2",[$report->patient,$report])}}">ویرایش تصاویر آزمایش</a>
                </div>
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
                </form>
                <br>
                <div class="back-box"><a href="{{route("reports")}}">بازگشت به نسخه ها</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
