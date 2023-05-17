<x-panel.layouts.header>
    <link rel="stylesheet" href="{{asset("admin/css/persian-datepicker.css")}}">
</x-panel.layouts.header>
<div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-financial-page">
                <h1>ویرایش تراکنش</h1>
                <br>
                <form action="{{route("financial.update",$financialTransaction)}}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <label for="title">عنوان<span class="star-red">*</span></label>
                        <input type="text" id="title" name="title" value="{{$financialTransaction->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}" {{$patient->national_code==$financialTransaction->patient->national_code?'selected':''}}>{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="payment_amount">مبلغ پرداختی<span class="star-red">*</span></label>
                        <input type="number" id="payment_amount" name="payment_amount" value="{{$financialTransaction->payment_amount}}">
                    </div>
                    <br>
                    <div>
                        <label for="method">نوع پرداخت<span class="star-red">*</span></label>
                        <select id="method" name="method">
                            @foreach($methods as $method)
                                <option value="{{$method}}" {{$method==$financialTransaction->method?'selected':''}}>{{$method}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="pay_time_date">زمان پرداخت<span class="star-red">*</span></label>
                        <input readonly type="text" id="pay_time_date" class="pay_time_date" dir="ltr"  value="{{ date("Y-m-d H:i:s",($financialTransaction->pay_time)) }}"/>
                        <input type="hidden" class="pay_time" value=""  id="pay_time" name="pay_time"/>
                    </div>
                    <br>
                    <div>
                        <label for="comment">توضیح</label>
                        <textarea name="comment" id="comment" rows="2">{{$financialTransaction->comment}}</textarea>
                    </div>
                    <br>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">
                </form>
                <br>
                <div class="back-box"><a href="{{route("financials")}}">بازگشت</a></div>
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
<x-panel.layouts.footer>
    <script src="{{asset("admin/js/jquery.js")}}" type="text/javascript"></script>
    <script src="{{asset("admin/js/persian-date.js")}}" type="text/javascript"></script>
    <script src="{{asset("admin/js/persian-datepicker.js")}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".pay_time_date").pDatepicker({
                "inline": false,
                "format": "YYYY/MM/DD  -  HH:m",
                "viewMode": "day",
                "initialValue": true,
                "minDate": null,
                "maxDate": null,
                "autoClose": true,
                "position": "auto",
                "altField": '.pay_time',
                "onlyTimePicker": false,
                "onlySelectOnDate": false,
                "calendarType": "persian",
                "inputDelay": 800,
                "observer": true,
                "calendar": {
                    "persian": {
                        "locale": "fa",
                        "showHint": false,
                        "leapYearMode": "algorithmic"
                    },
                    "gregorian": {
                        "locale": "en",
                        "showHint": false
                    }
                },
                "navigator": {
                    "enabled": true,
                    "scroll": {
                        "enabled": false
                    },
                    "text": {
                        "btnNextText": "بعد",
                        "btnPrevText": "قبل"
                    }
                },
                "toolbox": {
                    "enabled": false,
                    "calendarSwitch": {
                        "enabled": false,
                        "format": "MMMM"
                    },
                    "todayButton": {
                        "enabled": true,
                        "text": {
                            "fa": "امروز",
                            "en": "Today"
                        }
                    },
                    "submitButton": {
                        "enabled": false,
                        "text": {
                            "fa": "تایید",
                            "en": "Submit"
                        }
                    },
                    "text": {
                        "btnToday": "امروز"
                    }
                },
                "timePicker": {
                    "enabled": true,
                    "step": 1,
                    "hour": {
                        "enabled": true,
                        "step": null
                    },
                    "minute": {
                        "enabled": true,
                        "step": null
                    },
                    "second": {
                        "enabled": false,
                        "step": null
                    },
                    "meridian": {
                        "enabled": false
                    }
                },
                "dayPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY MMMM"
                },
                "monthPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY"
                },
                "yearPicker": {
                    "enabled": true,
                    "titleFormat": "YYYY"
                },
            });
        });
    </script>
</x-panel.layouts.footer>
