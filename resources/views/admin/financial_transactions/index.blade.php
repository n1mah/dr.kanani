<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="financial-page">
                <h1>تراکنش های مالی</h1>
                <br>
                <div class="add-box">
                    <a href="{{route("financial.addForm")}}">افزودن تراکنش جدید</a>
                </div>
                <br>
                <hr>
                <br>
                <h3>جستجو</h3>
                <span>جستجو در بین عنوان تراکنش , نام یا نام خانوادگی بیمار , کدملی بیمار , نوع پرداخت</span>
                <br>
                <form action="{{route("financials.search")}}" method="post" class="search-box">
                    @csrf
                    @method("post")
                    <label for="search">متن جستجو :</label>
                    <input type="search" id="search" name="search" placeholder="جستجو مورد نظر را وارد کنید ...">
                    <input type="submit" id="search_btn" value="جستجو">
                    <span class="split"></span>
                    <a href="{{route("financials")}}">نمایش همه</a>
                </form>
                <br>
                <hr>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>بیمار</th>
                            <th><small>تاریخ ثبت پرداخت</small></th>
                            <th>مبلغ</th>
                            <th><small>نوع پرداخت</small></th>
                            <th>مشاهده</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($financialTransactions as $financialTransaction)
                        <tr>
                            <td>{{$financialTransaction->id}}</td>
                            <td>{{$financialTransaction->title}}</td>
                            <td><a title="مشاهده" target="_blank" href="{{route("patient.show",$financialTransaction->patient)}}">{{$financialTransaction->patient->firstname}} {{$financialTransaction->patient->lastname}}</a></td>
                            <td>{{$financialTransaction->created_at}}</td>
                            <td class="money">{{number_format((String)$financialTransaction->payment_amount)}}</td>
                            <td>{{$financialTransaction->method}}</td>
                            <td>
                                <form action="{{route("financial.show",$financialTransaction)}}" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$financialTransaction->id}}">
                                    <button class="btn_see">مشاهده</button>
                                </form>
                            </td>
                            <td>
{{--                                <form action="{{route("financial.editForm",$financialTransaction)}}" method="get">--}}
                                <form action="" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$financialTransaction->id}}">
                                    <button class="btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
{{--                                <form action="{{route("financial.delete",$financialTransaction)}}" method="post">--}}
                                <form action="" method="post">
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
                    <x-panel.pagination :lists="$financialTransactions" />
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
