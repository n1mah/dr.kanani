<x-panel.layouts.header>
    <link rel="stylesheet" href="{{asset("admin/css/persian-datepicker.css")}}">
</x-panel.layouts.header>
<div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-appointment-page">
                <h1>ویرایش وقت ویزیت</h1>
                <br>
                <form action="{{route("appointment.update",$appointment)}}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}" {{ $patient->national_code == $appointment->patient_id ? 'selected' : '' }}>{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع <span class="star-red">*</span></label>
                        <select id="type" name="type">
                            <option value="ویزیت" {{ $appointment->type == "ویزیت" ? 'selected' : '' }}>ویزیت</option>
                            <option value="بررسی آزمایش یا تست" {{ $appointment->type == "بررسی آزمایش یا تست" ? 'selected' : '' }}>بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="visit_time_date">تاریخ و زمان ویزیت<span class="star-red">*</span></label>
                        <input readonly type="text" id="visit_time_date" class="visit_time_date"  value="{{ date("Y-m-d H:i:s",($appointment->visit_time-(3600*4.5))) }}" dir="ltr" />
                        <input type="hidden" class="visit_time"  id="visit_time" name="visit_time"/>
                    </div>
                    <br>
                    <div>
                        <label for="description">توضیح</label>
                        <textarea id="description" rows="5" name="descriptions">{{ $appointment->descriptions }}</textarea>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a>
                </div>
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
            $(".visit_time_date").pDatepicker({
                "inline": false,
                "format": "YYYY/MM/DD  -  HH:m",
                "viewMode": "day",
                "initialValue": true,
                "minDate": null,
                "maxDate": null,
                "autoClose": true,
                "position": "auto",
                "altField": '.visit_time',
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
