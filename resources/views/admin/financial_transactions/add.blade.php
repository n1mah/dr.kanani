<x-panel.layouts.header>
    <link rel="stylesheet" href="{{asset("admin/css/persian-datepicker.css")}}">
</x-panel.layouts.header>
<div id="main">
    <x-panel.aside />
    <div class="body">
        <x-panel.header-body />
        <hr>
        <div id="add-financial-page">
            <h1>{{$title_h1}}</h1>
            <br>
            <form action="{{route("financial.store")}}" method="post">
                @csrf
                @method('post')
                <div>
                    <label for="title">عنوان@if(isset($visit))@else<span class="star-red">*</span>@endif</label>
                    <input type="text" @if(isset($visit))class="readonly" readonly @endif id="title" name="title"
                           value="@if(isset($visit))حق ویزیت دکتر@endif">
                </div>
                <br>
                <div>
                    @if(isset($visit))
                        <label for="patient">بیمار</label>
                        <input type="text" class="readonly" readonly value="{{$patient->firstname}} {{$patient->lastname}}" id="patient" name="patient">
                        <input type="hidden" name="patient_id" value="{{$patient->national_code}}">
                        <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                    @else
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option
                                    value="{{$patient->national_code}}"
                                    @if(isset($patient_id) && !is_null($patient_id))
                                        @if($patient_id==$patient->national_code) selected @endif
                                    @endif
                                >{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <br>
                @if(isset($visit))
                    <br>
                    <hr>
                    <br>
                @endif
                <div>
                    <label for="payment_amount">مبلغ پرداختی<span class="star-red">*</span></label>
                    <input type="number" id="payment_amount" name="payment_amount"
                           @if(isset($visit))value="{{$patient->insurance->fee}}"@else
                               value=""@endif>
                </div>
                <br>
                <div>
                    <label for="method">نوع پرداخت<span class="star-red">*</span></label>
                    <select id="method" name="method">
                        @foreach($methods as $method)
                            <option value="{{$method}}">{{$method}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <label for="pay_time_date">زمان پرداخت<span class="star-red">*</span></label>
                    <input readonly type="text" id="pay_time_date" class="pay_time_date" dir="ltr" />
                    <input type="hidden" class="pay_time"  id="pay_time" name="pay_time"/>
                </div>
                <br>
                <hr>
                <br>
                <br>
                <div>
                    <label for="comment">توضیح</label>
                    <textarea name="comment" id="comment" rows="2"></textarea>
                </div>
                <br>
                <input class="btn" type="submit" value="افزودن">
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
