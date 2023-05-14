<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="edit-special-prescription-page">
                <h1> ویرایش تصاویر نسخه </h1>
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
                    <div class="btn-group">
                        <input class="btn-img" type="submit" value="افزودن تصاویر">
                    </div>
                </form>
                <br>
                <div class="show-images">
                    <p>برای مشاهده دقیق تر هرکدام از تصاویر بر روی آن کلیک کنید
                    <br>
                    برای حذف هر کدام روز حذف در آن بزنید</p>
                    <br>
                    <div class="parent-box">
                        @foreach($prescription->images as $image)
                            <div class="box">
                                <a href="{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}" target="_blank"><img src="{{asset("images/prescriptions/$image->image_path")}}" width="300px" alt="prescription-{{asset("images/prescriptions/$image->image_path")}}" title="prescription-{{asset("images/prescriptions/$image->image_path")}}"></a>
                                <form action="{{route("prescription.image.delete",[$prescription,$image])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn_del">حذف</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <br>
                <div class="btn-back-group"><a href="{{route("prescription.edit_special",$prescription)}}">بازگشت به ویرایش</a></div>
                <br>
                @if($errors->any())
                    <div class="errorBox">
                        @foreach($errors->all() as $error)
                            <strong>- {{ $error }}</strong>
                        @endforeach
                    </div>
                @endif
                <br>
                <br>
            </div>
        </div>
    </div>
<x-panel.layouts.footer />
