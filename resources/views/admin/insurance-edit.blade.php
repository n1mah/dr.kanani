<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-insurance-page">
                <h1>ویرایش بیمه</h1>

                <br>
                <form action="{{route("insurance.update",$insurance)}}" method="post">
                    @csrf
                    @method('put')
                    <div>
                        <label for="title">عنوان</label>
                        <input type="text" id="title" name="title" value="{{$insurance->title}}">
                    </div>
                    <br>
                    <div>
                        <label for="fee">مبلغ ویزیت</label>
                        <input type="text" id="fee" name="fee" value="{{$insurance->fee}}">
                    </div>
                    <br>
                    <input class="btn" type="submit" value="ویرایش">
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("insurances")}}">بازگشت</a>
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
