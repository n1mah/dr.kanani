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
                <div class="add-box">
                    <a href="{{route("appointment.addForm")}}">افزودن وقت جدید</a>
                </div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نوع</th>
                            <th>وقت ملاقات</th>
                            <th>توضیح وقت</th>
                            <th>نسخه</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{$appointment->id}}</td>
                            <td>{{$appointment->type}}</td>
                            <td>{{$appointment->visit_time}}</td>
                            <td>{{$appointment->descriptions}}</td>
                            <td>
                                @if(count($appointment->prescriptions)>0)
                                    <form action="{{route("appointment.prescriptions",$appointment)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn_prep">مشاهده نسخه ها</button>
                                    </form>
                                @else
                                    <span class="btn_disable">نوبت نسخه ای ندارد</span>
                            @endif
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
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <x-panel.pagination :lists="$appointments" />
                </div>
                <br>
                <div class="btn-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
