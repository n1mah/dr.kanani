<x-panel.layouts.header>
    <link rel="stylesheet" href="{{asset("admin/css/persian-datepicker.css")}}">
</x-panel.layouts.header>
<div id="main">
    <x-panel.aside />
    <div class="body">
        <x-panel.header-body />
        <hr>
        <div id="add-analysis-page">
            <h1>افزودن کیس آنالیز</h1>
            <p>موردی را ک میخواهید بررسی کنید و مورد آزمایش زمانی قرار دهید وارد کنید</p>
            <br>
            <form action="{{route("analysis.store")}}" method="post">
                @csrf
                @method('post')
                <br>

                <div>
                    <label for="patient">بیمار</label>
                    <input type="text" title="patient" id="patient" >
                </div>
                <br>
                <div>
                    <label for="title">عنوان را وارد کنید</label>
                    <input type="text" title="title" id="title" >
                </div>
                <br>
                <input class="btn" type="submit" value="افزودن">
            </form>
            <br>
            <div class="back-box"><a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a></div>
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
<?php
