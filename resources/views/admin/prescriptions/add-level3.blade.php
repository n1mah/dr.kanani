<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-prescription-page">
                <h1>افزودن نسخه جدید<span> ( مرحله 3 از 3 ) </span></h1>
                <br>
                <p class="text-center">در این مرحله میتوانید نسخه خود را <span class="span1"> آپلود </span> کنید وبرای آن توضیحی بنویسید یا آن را به <span class="span2"> بعدا </span> موکول کنید</p>
                <p> اگر نسخه را وارد نکنید به طور پیشفرض به بعدا موکول می شود </p>
                <p>تصاویر بالای 2مگابایت آپلود نمی شوند</p>
                <br>
                <form action="{{route("prescription.update",$prescription)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <br>
                    <div class="form-group">
                        <label for="images">تصاویر نسخه<span class="star-red">*</span></label>
                        <label for="images" class="image_file">انتخاب تصاویر نسخه</label>
                        <input type="file" name="images[]" id="images" class="form-control custom-file-input" multiple required>
                    </div>
                    <br>
                    <div>
                        <label for="text_prescription">توضیح نسخه</label>
                        <textarea id="text_prescription" name="text_prescription" rows="2"></textarea>
                    </div>
                    <br><br>
                  <div class="btn-group">
                      <input class="btn" type="submit" value="ثبت نسخه">
                      <a href="{{route("prescriptions")}}">بعدا</a>
                  </div>
                </form>
                <br>
                <div class="back-box">
                    <a href="{{route("prescription.addForm1")}}">بازگشت به صفحه انتخاب بیمار</a>
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
