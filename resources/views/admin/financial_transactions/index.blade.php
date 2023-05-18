<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="financial-page">
                <h1>تراکنش های مالی</h1>
                <br>
                @if(isset($hasSearch))
                    <h2>بیمار : <a title="مشاهده" target="_blank" href="{{route("patient.show",$financialTransactions->first()->patient)}}"><span>{{$financialTransactions->first()->patient->firstname}} {{$financialTransactions->first()->patient->lastname}}</span></a></h2>
                @endif
                @if(isset($appointment))
                    <h2>نوبت : <a title="مشاهده" target="_blank" dir="ltr" href="{{route("appointment.show",$financialTransactions->first()->appointment)}}"><span>{{$financialTransactions->first()->appointment->visitTimeGetter}}</span></a></h2>
                @endif
                <div class="add-box"><a href="{{route("financial.addForm")}}@if(isset($patient_id_add)&&!is_null($patient_id_add))?patient={{$patient_id_add}}@endif">افزودن تراکنش جدید</a></div>
                <br>
                <hr>
                @if(!isset($hasSearch))
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
                </form>
                <br>
                <hr>
                    <br>
                    <div class="btn-list">
                        <a class="btn-data" href="{{route("financials")}}">تراکنشات مالی فعال</a>
                        <a class="btn-data" href="{{route("financials.all")}}">همه تراکنش های مالی</a>
                        <a class="btn-data" href="{{route("financials.inactive")}}">تراکنشات مالی حذف شده</a>
                        <a class="btn-data" href="{{route("financials.ordered")}}">همه تراکنش های مالی به ترتیب زمان</a>
                        <a class="btn-data" href="{{route("financials.today")}}">تراکنش های مالی امروز</a>
                        <a class="btn-data" href="{{route("financials.last_7day")}}">تراکنش های مالی 7 روز گذشته</a>
                        <a class="btn-data" href="{{route("financials.last_30day")}}">تراکنش های مالی 30 روز گذشته</a>
                    </div>
                    <br>
                    <hr>
                @endif
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            @if(!isset($hasSearch))
                            <th>بیمار</th>
                            @endif
                            @if(!isset($appointment))
                            <th>نوبت</th>
                            @endif
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
                            @if(!isset($hasSearch))
                            <td><a title="مشاهده" target="_blank" href="{{route("patient.show",$financialTransaction->patient)}}">{{$financialTransaction->patient->firstname}} {{$financialTransaction->patient->lastname}}</a></td>
                            @endif
                            @if(!isset($appointment))
                            <td dir="ltr">
                                @if($financialTransaction->appointment)
                                    <a title="مشاهده" target="_blank" href="{{route("appointment.show",$financialTransaction->appointment)}}">
                                        {{$financialTransaction->appointment->visitTimeGetter}}
                                    </a>
                                @else
                                    <small>تراکنش به نوبتی متصل نیست</small>
                                @endif
                                </td>
                            @endif
                            <td dir="ltr">{{$financialTransaction->payTimeGetter}}</td>
                            <td class="money">{{number_format((String)$financialTransaction->payment_amount)}}</td>
                            <td>{{$financialTransaction->method}}</td>
                            <td>
                                <form action="{{route("financial.show",$financialTransaction)}}" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$financialTransaction->id}}">
                                    <button class="btn_see">مشاهده</button>
                                </form>
                            </td>
                            @if($financialTransaction->changeable==true)
                            <td>
                                <form action="{{route("financial.editForm",$financialTransaction)}}" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$financialTransaction->id}}">
                                    <button class="btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("financial.delete",$financialTransaction)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn_del">حذف</button>
                                </form>
                            </td>
                            @else
                                <td colspan="2">غیر قابل تغییر</td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if(!isset($search))
                    <div class="pagination">
                        <x-panel.pagination :lists="$financialTransactions" />
                    </div>
                @endif
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
