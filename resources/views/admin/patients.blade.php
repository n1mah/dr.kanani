<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="patients-page">
                <h1>بیماران</h1>
                <br>
                <div class="add-box">
                    <a href="{{route("patient.addForm")}}">افزودن بیمار جدید</a>
                </div>
                <br>
                <hr>
                <br>
                <form class="search-box">
                    <label for="search">نام / نام خانوادگی / کدملی / بیمه :</label>
                    <input type="search" id="search" placeholder="متن جستجو خود را وارد کنید ...">
                    <input type="submit" id="search_btn" value="جستجو">
                </form>
                <br>
                <hr>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کدملی</th>
                            <th>نام</th>
                            <th>موبایل</th>
                            <th>نوبت ها</th>
                            <th>نسخه ها</th>
                            <th>آزمایشات/گزارشات</th>
                            <th>اطلاعات</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->national_code}}</td>
                            <td>{{$patient->firstname}} {{$patient->lastname}}</td>
                            <td>{{$patient->mobile}}</td>
                            <td>
                                <form action="{{route("patient.appointments",$patient)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_visit">مشاهده</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("patient.prescriptions",$patient)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_prep">مشاهده</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("patient.reports",$patient)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_report">مشاهده</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("patient.show",$patient)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_show">مشاهده</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("patient.editForm",$patient)}}" method="get">
                                    @csrf
                                    <button type="submit" class="btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("patient.delete",$patient)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class=" btn_del">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <x-panel.pagination :lists="$patients" />
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
