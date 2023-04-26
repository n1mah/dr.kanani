<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-insurance-page">
                <h1>ویرایش بیمه</h1>

                <br>
                <form action="{{route("insurance.update")}}" method="post">
                    @csrf
                    <div>
                        <label for="title">عنوان</label>
                        <input type="text" id="title">
                    </div>
                    <br>
                    <div>
                        <label for="fee">مبلغ ویزیت</label>
                        <input type="number" id="fee">
                    </div>
                    <br>
                    <input class="btn" type="button" value="ویرایش">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("insurances")}}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
