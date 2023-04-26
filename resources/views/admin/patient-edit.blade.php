<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-patient-page">
                <h1>ویرایش بیمار</h1>

                <br>
                <form action="{{route("patient.update")}}" method="post">
                    @csrf
                    <div>
                        <label for="fName">نام</label>
                        <input type="text" id="fName">
                    </div>
                    <br>
                    <div>
                    <label for="lName">نام خانوادگی</label>
                    <input type="text" id="lName">
                    </div>
                    <br>
                    <div>
                    <label for="birth">تولد</label>
                    <input type="text" id="birth">
                    </div>
                    <br>
                    <div>
                    <label for="insurance">نوع بیمه</label>
                    <select id="insurance">
                        <option value="">تامین اجتماعی</option>
                        <option value="">آزاد</option>
                    </select>
                    </div>
                    <br>
                    <div>
                    <label for="mobile">موبایل</label>
                    <input type="number" id="mobile">
                    </div>
                    <br>
                    <div>
                    <label for="phone">تلفن ثابت</label>
                    <input type="number" id="phone">
                    </div>
                    <br>
                    <input class="btn" type="button" value="ویرایش">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("patients")}}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
