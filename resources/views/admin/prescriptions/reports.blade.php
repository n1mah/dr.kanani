<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="prescriptions-page">
                <h1>گزارشات و آزمایشات</h1>
                <br>
                <h2>بیمار : <span>{{$patient->firstname}} {{$patient->lastname}}</span></h2>
                <br>
                <h2>نسخه <br><br> <span>{{$prescription->reason}} <br><br>{{$prescription->text_prescription}}</span></h2>
                <br>
                <div class="add-box">
                    <a href="{{route("report.addForm")}}@if(isset($patient_id_add)&&!is_null($patient_id_add))?patient={{$patient_id_add}}@endif">افزودن گزارش جدید</a>
                </div>
                <br>
                @if(count($reports)>0)
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>عنوان</th>
                            <th>محتوا</th>
                            <th>نسخه</th>
                            <th>مشاهده</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{$report->id}}</td>
                            <td>{{$report->title}}</td>
                            <td>{{$report->content}}</td>
                            <td>
                                @isset($report->prescription->id)
                                    {{ $report->prescription->id}}<br>{{$report->prescription->reason}}
                                @endisset
                            </td>
                            <td>
                               <form action="{{route("report.show",$report)}}" method="get">
                                        @csrf
                                        <button type="submit" class="btn_see">مشاهده</button>
                               </form>
                            </td>
                            <td>
                                <form  action="{{route("report.edit_special",$report)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("report.delete",$report)}}" method="post">
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
                    <x-panel.pagination :lists="$reports" />
                </div>
                @else
                    <p class="not_record">گزارش یا آزمایشی برای این نسخه بیمار وجود ندارد</p>
                @endif
                <br>
                <div class="btn-box"><a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a></div>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
