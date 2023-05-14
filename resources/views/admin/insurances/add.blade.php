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
                    @method('post')
                    <div>
                        <label for="title">عنوان</label>
                        <input type="text" id="title" name="title">
                    </div>
                    <br>
                    <div>
                    <label for="fee">مبلغ ویزیت</label>
                    <input type="number" id="fee" name="fee">
                    </div>
                    <br>
                    <input class="btn" type="submit" value="افزودن">
                </form>
                <br>
                <div class="back-box"><a href="{{route("insurances")}}">بازگشت</a></div>
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
