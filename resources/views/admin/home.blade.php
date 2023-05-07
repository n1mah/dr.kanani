
<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="home">
                <div class="right-body">
                    <div class="today-appointment">
                        <h2>نوبت های امروز</h2>
                        <table>
                            <thead>
                            <tr>
                                <th>نام بیمار</th>
                                <th>وقت ملاقات</th>
                                <th>وضعیت</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td @if($appointment->status==2) class="text_cancel" @elseif($appointment->status==1)  class="text_success" @endif>{{$appointment->patient->firstname}} {{$appointment->patient->lastname}}</td>
                                    <td @if($appointment->status==2) class="text_cancel" @elseif($appointment->status==1)  class="text_success" @endif dir="ltr">{{date("Y-m-d",$appointment->visit_time)}} - {{date(" H:i:s",$appointment->visit_time)}}</td>
                                    @if($appointment->status==0)
                                        <td class="text_unknown">
                                            <span class="text_unknown">تعیین نشده</span>
                                        </td>
                                    @elseif($appointment->status==1)
                                        <td class="text_success">
                                            <span class="text_success">ویزیت شده</span>
                                        </td>
                                    @elseif($appointment->status==2)
                                        <td class="text_cancel" colspan="2">
                                            <span class="text_cancel">کنسلی</span>
                                        </td>
                                    @endif
                                        @if($appointment->status==2)
{{--                                            <td class="text_cancel"></td>--}}
                                        @else

                                            <td @if($appointment->status==2) class="text_cancel" @elseif($appointment->status==1)  class="text_success" @endif>
                                                <form action="{{route("appointment.show",$appointment)}}" method="get">
                                                    @csrf
                                                    <button type="submit" class="btn_see">مشاهده</button>
                                                </form>
                                            </td>
                                        @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="btn-list">
                            <a class="btn-data" href="{{route("appointments")}}">همه وقت ها</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
