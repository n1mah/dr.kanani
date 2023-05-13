<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-report-page">
                <h1> ویرایش نسخه </h1>
                <br>
                <form action="{{route("report.update",$report)}}" method="post">
                    @csrf
                    @method("put")
                    <br>
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient_item)
                                <option value="{{$patient_item->national_code}}" {{ $report->patient->national_code == $patient_item->national_code ? 'selected' : ''}}>{{$patient_item->firstname}} {{$patient_item->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="title">عنوان<span class="star-red">*</span></label>
                        <input id="title" name="title" value="{{$report->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="content">محتوا گزارش<span class="star-red">*</span></label>
                        <textarea id="content" name="content" rows="6">{{$report->content}}</textarea>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">

                </form>

                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت به نسخه ها</a>
                </div>

            </div>
        </div>
    </div>

<x-panel.layouts.footer />
