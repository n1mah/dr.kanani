<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="prescriptions-page">
                <h1>نسخه ها</h1>
                <br>
                <div class="add-box"><a href="{{route("prescription.addForm1")}}">افزودن نسخه جدید</a></div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>دلیل مراجعه</th>
                            <th>نام بیمار</th>
                            <th>نوع</th>
                            <th>نسخه</th>
                            <th>گزارش/آزمایش</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{$prescription->id}}</td>
                            <td>{{$prescription->reason}}</td>
                            <td><a title="مشاهده" target="_blank" href="{{route("patient.show",$prescription->appointment->patient)}}">{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}</a></td>
                            <td>{{$prescription->type}}</td>
                            <td>
                                @if(count($prescription->images)<1)
                                    <form action="{{route("prescription.editForm",$prescription)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn_add">افزودن نسخه</button>
                                    </form>
                                @else
                                    <form action="{{route("prescription.show",$prescription)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn_see">مشاهده جزییات</button>
                                    </form>
                                @endif

                            </td>
                            <td>
                                @if(($prescription->reports()->count()>0))
                                    <form action="{{route("prescription.reports",$prescription)}}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$prescription->reports->first()->patient_id}}">
                                        <button type="submit" class="btn_report">مشاهده</button>
                                    </form>
                                @else
                                        @csrf
                                        <span>گزارش یا آزمایش ندارد</span>
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
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
