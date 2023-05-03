<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-prescription-page">
                <h1> مشاهده جزییات  نسخه </h1>
                <br>
                <form action="">
                    @csrf
                    <br>
                    <div>
                        <label for="name">بیمار</label>
                        <input type="text" disabled id="name" value="{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="visit">وقت انتخاب شده</label>
                        <input type="text" disabled id="visit" value="{{$prescription->appointment->visit_time}}">
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع ویزیت</label>
                        <input type="text" disabled id="type" value="{{$prescription->type}}">
                    </div>
                    <br>
                    <div>
                        <label for="reason">علت مراجعه</label>
                        <textarea id="reason" disabled name="text_prescription" rows="6">{{$prescription->reason}}</textarea>
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">نسخه</label>
                        <textarea id="text_prescription" disabled name="text_prescription" rows="6">{{$prescription->text_prescription}}</textarea>
                    </div>
                    <br>

                    <br>
                </form>

                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت به نسخه ها</a>
                </div>

            </div>
        </div>
    </div>

<x-panel.layouts.footer />
