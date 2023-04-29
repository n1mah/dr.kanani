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
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>کدملی</th>
                            <th>نام</th>
                            <th>تولد</th>
                            <th>بیمه</th>
                            <th>موبایل</th>
                            <th>تلفن</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td>{{$patient->national_code}}</td>
                            <td>{{$patient->firstname}} {{$patient->lastname}}</td>
                            <td>{{$patient->year}}/{{$patient->month}}/{{$patient->day}}</td>
                            <td>{{$patient->insurance->title}}</td>
                            <td>{{$patient->mobile}}</td>
                            <td>{{$patient->phone}}</td>
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
