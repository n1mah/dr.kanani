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
                    <a href="{{route("report.editForm",$report)}}">ویرایش جزییات گزارش&nbsp;  (و ویرایش بیمار)</a>
                    <a href="{{route("report.addForm2",[$report->patient,$report])}}">ویرایش نسخه &nbsp;    (مربوط به گزارش)</a>
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
                        <textarea disabled id="content" name="content" rows="6">{{$report->content}}</textarea>
                    </div>
                    <br>
                </form>
                <br>
                <div class="back-box"><a href="{{route("reports")}}">بازگشت به نسخه ها</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
