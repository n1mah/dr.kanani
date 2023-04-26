<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="insurances-page">
                <h1>بیمه ها</h1>
                <br>
                <div class="add-box">
                    <a href="{{route("insurance.addForm")}}">افزودن بیمه جدید</a>
                </div>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان بیمه</th>
                            <th>مبلغ ویزیت</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <form action="{{route("insurance.editForm")}}" method="get">@csrf <button class="btn_up">ویرایش</button></form>
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
