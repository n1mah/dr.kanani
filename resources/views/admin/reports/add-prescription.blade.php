<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-report-page">
                <h1>افزودن آزمایش یا گزارش - مرحله 2</h1>
                <br>
                <p>اتصال نسخه مربوط به آزمایش</p>
                <form action="{{route("report.store_prescription",$report)}}" method="post">
                    @csrf
                    @method('post')
                    <div>
                        <label for="prescription_id">نسخه<span class="star-red">*</span></label>
                        <select id="prescription_id" name="prescription_id">
                            <option value="">نسخه ندارد</option>
                            @foreach($prescriptions as $prescription)
                                <option value="{{$prescription->id}}" @isset($report->prescription->id) {{ $report->prescription->id == $prescription->id ? 'selected' : ''}}@endisset>{{$prescription->id}} {{$prescription->reason}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="ثبت نسخه مربوط به آزمایش / گزارش ">
                </form>
                <br>
                <div class="back-box"><a href="{{route("reports")}}">بازگشت</a></div>
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
