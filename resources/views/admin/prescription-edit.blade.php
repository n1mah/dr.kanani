<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-prescription-page">
                <h1> افزودن متن نسخه / ویرایش  نسخه </h1>
                <br>
                <form action="{{route("prescription.update",$prescription)}}" method="post">
                    @csrf
                    @method('post')
                    <br>
                    <div>
                        <label for="name">بیمار :</label>
                        <input type="text" disabled id="name" value="{{$prescription->appointment->patient->firstname}} {{$prescription->appointment->patient->lastname}}">
                    </div>
                    <br>
                    <div>
                        <label for="visit">وقت انتخاب شده :</label>
                        <input type="text" disabled id="visit" value="{{$prescription->appointment->visit_time}}">
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">نسخه<span class="star-red">*</span></label>
                        <textarea id="text_prescription" name="text_prescription" rows="6"></textarea>
                    </div>
                    <br>

                    <br>
                      <input class="btn" type="submit" value="ویرایش نسخه">
                </form>

                <br>
                <div class="back-box">
                    <a href="{{redirect()->back()->getTargetUrl() }}">بازگشت به نسخه ها</a>
                </div>


                @if($errors->any())
                    <div class="errorBox">
                        @foreach($errors->all() as $error)
                            <strong>- {{ $error }}</strong>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
