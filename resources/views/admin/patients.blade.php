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
                            <th>نام خانوادگی</th>
                            <th>تولد</th>
                            <th>بیمه</th>
                            <th>موبایل</th>
                            <th>تلفن</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <form action="{{route("patient.editForm")}}" method="get">@csrf <button class="btn_up">ویرایش</button></form>
                            </td>
                            <td>
                                <form action="" method="post">@csrf <button class="btn_del">حذف</button></form>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
