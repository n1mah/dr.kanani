<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="patient-appointments-page">
                <h1>وقت های ویزیت</h1>
                <br>
                <h2>بیمار : <span>{{$appointments->first()->patient->firstname}} {{$appointments->first()->patient->lastname}}</span></h2>
                <div class="add-box"><a href="{{route("appointment.addForm")}}@if(isset($patient_id_add)&&!is_null($patient_id_add))?patient={{$patient_id_add}}@endif">افزودن وقت جدید</a></div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نوع</th>
                            <th>وقت ملاقات</th>
                            <th>توضیح وقت</th>
                            <th>وضعیت</th>
                            <th>تغییر</th>
                            <th>نسخه</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td @if($appointment->status==2) class="text_cancel" @endif>{{$appointment->id}}</td>
                            <td @if($appointment->status==2) class="text_cancel" @endif>{{$appointment->type}}</td>
                            <td @if($appointment->status==2) class="text_cancel" @endif>{{$appointment->visitTimeGetter}}</td>
                            <td @if($appointment->status==2) class="text_cancel" @endif>{{$appointment->descriptions}}</td>
                            @if($appointment->status==0)
                                <td class="text_unknown">
                                    <span class="text_unknown">تعیین نشده</span>
                                </td>
                            @elseif($appointment->status==1)
                                <td class="text_success">
                                    <span class="text_success">ویزیت شده</span>
                                </td>
                            @elseif($appointment->status==2)
                                <td class="text_cancel">
                                    <span class="text_cancel">کنسلی</span>
                                </td>
                            @endif

                            @if($appointment->status==0)
                                <td>
                            @elseif($appointment->status==1)
                                <td class="text_success">
                            @elseif($appointment->status==2)
                                <td class="text_cancel">
                                    @endif
                                    @if($appointment->status==0)
                                        <form action="{{route("appointment.cancel",$appointment)}}" method="post">
                                            @csrf
                                            @method("put")
                                            <button type="submit" class="btn_cancel">کنسل</button>
                                        </form>
                                        <form action="{{route("appointment.success",$appointment)}}" method="post">
                                            @csrf
                                            @method("put")
                                            <button type="submit" class="btn_success">ویزیت شد</button>
                                        </form>
                                    @elseif($appointment->status==1 || $appointment->status==2)
                                        <span class="text_unknown">غیر قابل تغییر</span>
                                    @endif
                                </td>
                            @if($appointment->status==2)
                                <td class="text_cancel" colspan="3">
                                    <span class="text_cancel">نوبت کنسل شده</span>
                                </td>
                            @else
                                <td>
                                    @if(count($appointment->prescriptions)>0)
                                        <form action="{{route("appointment.prescriptions",$appointment)}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn_prep">مشاهده نسخه ها</button>
                                        </form>
                                    @else
                                        <span class="btn_disable">نوبت نسخه ای ندارد</span>
                                    @endif
                                </td>
                            @endif

                            @if($appointment->status!=2)
                                <td>
                                    <form action="{{route("appointment.editForm",$appointment)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn_up">ویرایش</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route("appointment.delete",$appointment)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn_del">حذف</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <x-panel.pagination :lists="$appointments" />
                </div>
                <br>
                <div class="btn-box"><a href="{{$back}}">بازگشت</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
