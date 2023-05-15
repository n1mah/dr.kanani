<x-panel.layouts.header />
<div id="main">
    <x-panel.aside />
    <div class="body">
        <x-panel.header-body />
        <hr>
        <div id="appointment-prescriptions-page">
            <h1>نسخه ها</h1>
            <br>
            <h2>بیمار : <span>{{$prescriptions->first()->appointment->patient->firstname}} {{$prescriptions->first()->appointment->patient->lastname}}</span></h2>
            <h2>وقت : <span>{{$prescriptions->first()->appointment->visit_time}}</span></h2>
            <div class="add-box"><a href="{{route("prescription.addForm1")}}@if(isset($patient_id_add)&&!is_null($patient_id_add))?patient={{$patient_id_add}}@endif">افزودن نسخه جدید</a></div>
            <br>
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>کد</th>
                        <th>دلیل مراجعه</th>
                        <th>نوع</th>
                        <th>نسخه</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{$prescription->id}}</td>
                            <td>{{$prescription->reason}}</td>
                            <td>{{$prescription->type}}</td>
                            <td>
                                @if(empty(trim($prescription->text_prescription)))
                                    <form action="{{route("prescription.editForm",$prescription)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn_add">افزودن متن نسخه</button>
                                    </form>
                                @else
                                    <form action="{{route("prescription.show",$prescription)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn_see">مشاهده جزییات</button>
                                    </form>
                                @endif

                            </td>
                            <td>
                                <form action="{{route("prescription.edit_special",$prescription)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("prescription.delete",$prescription)}}" method="post">
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
                <x-panel.pagination :lists="$prescriptions" />
            </div>
            <br>
            <div class="btn-box"><a href="{{$back}}">بازگشت</a></div>
        </div>
    </div>
</div>
<x-panel.layouts.footer />
