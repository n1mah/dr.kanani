<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-appointment-page">
                <h1>مشاهده وقت ویزیت</h1>
                <br>
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
                        <input disabled type="number" id="visit_time" name="visit_time" value="{{ $appointment->visit_time }}">
                    </div>
                    <br>
                    <div>
                        <label for="description">توضیح</label>
                        <textarea rows="5" disabled id="description" name="descriptions">{{ $appointment->descriptions }}</textarea>
                    </div>
                    <br>
                </form>
                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت</a>
                </div>
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
                      <form class="status" action="{{route("appointment.success",$appointment)}}" method="post">
                          @csrf
                          @method("put")
                          <button type="submit" class="btn_success">ویزیت</button>
                      </form>
                  </div>
                @endif
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
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
