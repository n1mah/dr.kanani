<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="reports-page">
                <h1>گزارشات و آزمایشات</h1>
                <br>
                <div class="add-box">
                    <a href="">افزودن گزارش جدید</a>
                </div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کد</th>
                            <th>عنوان</th>
                            <th>محتوا</th>
                            <th>نام بیمار</th>
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
                            <td>{{$report->patient->firstname}} {{$report->patient->lastname}}</td>
                            <td>
                                @isset($report->prescription->id)
                                    {{ $report->prescription->id}}<br>{{$report->prescription->reason}}
                                @endisset
                            </td>
                            <td>
{{--                                @if(empty(trim($report->text_prescription)))--}}
                                    <form action="" method="post">
                                        @csrf
                                        <button type="submit" class="btn_see">مشاهده</button>
                                    </form>
{{--                                @endif--}}

                            </td>
                            <td>
                                <form action="" method="get">
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
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
