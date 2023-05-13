<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="show-financial-page">
                <h1>مشاهده تراکنش</h1>
                <br>
                <form>
                    <div>
                        <label for="title">عنوان<span class="star-red">*</span></label>
                        <input disabled type="text" id="title" name="title" value="{{$financialTransaction->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select disabled id="patient_id" name="patient_id">
                                <option>{{$financialTransaction->patient->firstname}} {{$financialTransaction->patient->lastname}}</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="payment_amount">مبلغ پرداختی<span class="star-red">*</span></label>
                        <input disabled type="number" id="payment_amount" name="payment_amount" value="{{$financialTransaction->payment_amount}}">
                    </div>
                    <br>
                    <div>
                        <label for="method">نوع پرداخت<span class="star-red">*</span></label>
                        <select disabled id="method" name="method">
                                <option>{{$financialTransaction->method}}</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="comment">توضیح</label>
                        <textarea disabled name="comment" id="comment" rows="2">{{$financialTransaction->comment}}</textarea>
                    </div>
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("financials")}}">بازگشت</a>
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
