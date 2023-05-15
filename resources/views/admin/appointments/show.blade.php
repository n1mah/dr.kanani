<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-appointment-page">
                <h1>مشاهده وقت ویزیت</h1>
                <br>
                <div class="box-btn">
                        <form action="{{route("appointment.editForm",$appointment)}}" method="get">
                            @csrf
                            <button type="submit" class="btn_up">ویرایش</button>
                        </form>
                        <form action="{{route("appointment.delete",$appointment)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn_del">حذف</button>
                        </form>
                        @if(count($appointment->prescriptions)>0)
                            <form action="{{route("appointment.prescriptions",$appointment)}}" method="get">
                                @csrf
                                <button type="submit" class="btn_see">مشاهده نسخه ها این نوبت</button>
                            </form>
                        @else
                            <form>
                                <a type="submit" class="btn_see" onclick="alert('برای این نوبت نسخه ای ثبت نشده');return false;">مشاهده نسخه های نوبت</a>
                            </form>
                        @endif
                        @if(count($appointment->financialTransactions)>0)
                            <form action="{{route("financials.appointment",$appointment)}}" method="get">
                                @csrf
                                <button type="submit" class="btn_financial">مشاهده تراکنشات نوبت</button>
                            </form>
                        @else
                        <form>
                            <a type="submit" class="btn_financial" onclick="alert('برای این نوبت تراکنش مالی ثبت نشده');return false;">مشاهده تراکنش های نوبت</a>
                        </form>
                        @endif

                </div>
                <form class="form">
                    <div>
                        <label for="patient_id">بیمار</label>
                        <select disabled id="patient_id" name="patient_id">
                                <option>{{$appointment->patient->firstname}} {{$appointment->patient->lastname}}</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="type">نوع </label>
                        <select disabled id="type" name="type">
                            <option value="ویزیت" {{ $appointment->type == "ویزیت" ? 'selected' : '' }}>ویزیت</option>
                            <option value="بررسی آزمایش یا تست" {{ $appointment->type == "بررسی آزمایش یا تست" ? 'selected' : '' }}>بررسی آزمایش یا تست</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="visit_time">زمان ویزیت</label>
                        <input disabled dir="ltr" id="visit_time" name="visit_time" value="{{ $appointment->visitTimeGetter }}">
                    </div>
                    <br>
                    <div>
                        <label for="description">توضیح</label>
                        <textarea rows="5" disabled id="description" name="descriptions">{{ $appointment->descriptions }}</textarea>
                    </div>
                    <br><br>
                    <div>
                        <label for="visit_time">وضعیت</label>
                        @php
                        $status_str="";
                            if($appointment->status==0){
                                $status_str="تعیین نشده";
                                $status_cls="v0";
                            }elseif ($appointment->status==1){
                                $status_str="ویزیت شده";
                                $status_cls="v1";
                            }elseif ($appointment->status==2){
                                $status_str="کنسل شده";
                                $status_cls="v2";
                            }
                         @endphp
                        <input disabled id="status" name="status" class="{{$status_cls}}" value="{{ $status_str }}">

                    </div>
                </form>
                <br>
                <div class="back-box"><a href="{{$back }}">بازگشت</a></div>
                <br>
                @if($appointment->status==0)
                    <hr>
                  <div class="parent-status">
                      <h2>تغییر وضعیت :</h2>
                      <form class="status" action="{{route("appointment.cancel",$appointment)}}" method="post">
                          @csrf
                          @method("put")
                          <button type="submit" class="btn_cancel">کنسل</button>
                      </form>
                      <form class="status" action="{{route("appointment.success",$appointment)}}" method="get">
                          @csrf
                          <button type="submit" class="btn_success">ویزیت شد</button>
                      </form>
                  </div>
                @endif
                @if(count($prescriptions)>0)
                <hr>
                <br>
                <h2>نسخه های وقت</h2>
                <br>
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
                @else
                    <p class="text-center">نسخه ای برای این وقت ویزیت وجود ندارد</p>
                @endif
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
