<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-report-page">
                <h1> مشاهده گزارش و آزمایش  </h1>
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
                        <textarea disabled id="content" name="content" rows="6">{{$report->content}}</textarea>
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
                            <textarea disabled id="content" name="content" rows="6">{{$report->prescription->text_prescription}}</textarea>
                        </div>
                    @endif
                    <br>
                </form>

                <br>
                <div class="back-box">
                    <a href="{{route("reports")}}">بازگشت به نسخه ها</a>
                </div>

            </div>
        </div>
    </div>

<x-panel.layouts.footer />
