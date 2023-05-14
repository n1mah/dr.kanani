<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-financial-page">
                <h1>ویرایش تراکنش</h1>
                <br>
                <form action="{{route("financial.update",$financialTransaction)}}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <label for="title">عنوان<span class="star-red">*</span></label>
                        <input type="text" id="title" name="title" value="{{$financialTransaction->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option value="{{$patient->national_code}}" {{$patient->national_code==$financialTransaction->patient->national_code?'selected':''}}>{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="payment_amount">مبلغ پرداختی<span class="star-red">*</span></label>
                        <input type="number" id="payment_amount" name="payment_amount" value="{{$financialTransaction->payment_amount}}">
                    </div>
                    <br>
                    <div>
                        <label for="method">نوع پرداخت<span class="star-red">*</span></label>
                        <select id="method" name="method">
                            @foreach($methods as $method)
                                <option value="{{$method}}" {{$method==$financialTransaction->method?'selected':''}}>{{$method}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="comment">توضیح</label>
                        <textarea name="comment" id="comment" rows="2">{{$financialTransaction->comment}}</textarea>
                    </div>
                    <br>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">
                </form>
                <br>
                <div class="back-box"><a href="{{route("financials")}}">بازگشت</a></div>
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
