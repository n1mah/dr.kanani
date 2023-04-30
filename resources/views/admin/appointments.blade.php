<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="appointments-page">
                <h1>وقت های ویزیت</h1>
                <br>
                <div class="add-box">
                    <a href="{{route("appointment.addForm")}}">افزودن وقت جدید</a>
                </div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>نام بیمار</th>
                            <th>نوع</th>
                            <th>وقت ملاقات</th>
                            <th>توضیح وقت</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{$appointment->id}}</td>
                            <td>{{$appointment->patient->firstname}} {{$appointment->patient->lastname}}</td>
                            <td>{{$appointment->type}}</td>
                            <td>{{$appointment->visit_time}}</td>
                            <td>{{$appointment->descriptions}}</td>
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
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
