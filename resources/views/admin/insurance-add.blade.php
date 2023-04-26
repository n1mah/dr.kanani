<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-insurance-page">
                <h1>افزودن بیمه جدید</h1>

                <br>
                <form action="{{route("insurance.store")}}" method="post">
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
                    <input class="btn" type="button" value="افزودن">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("insurances")}}">بازگشت</a>
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
