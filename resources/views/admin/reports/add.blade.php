<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="add-report-page">
                <h1>افزودن آزمایش یا گزارش جدید</h1>
                <br>
                <p>بیمار مورد نظر را انتخاب کنید</p>
                <form action="{{route("report.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div>
                        <label for="patient_id">بیمار<span class="star-red">*</span></label>
                        <select id="patient_id" name="patient_id">
                            @foreach($patients as $patient)
                                <option
                                    value="{{$patient->national_code}}"
                                    @if(isset($patient_id) && !is_null($patient_id))
                                        @if($patient_id==$patient->national_code) selected @endif
                                    @endif
                                >{{$patient->firstname}} {{$patient->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="title">عنوان<span class="star-red">*</span></label>
                        <input  id="title" name="title">
                    </div>
                    <br>
                    <div>
                        <label for="content">توضیح گزارش</label>
                        <textarea id="content" name="content" rows="3"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="images">انتخاب<span class="star-red">*</span></label>
                        <label for="images" class="image_file">انتخاب تصاویر گزارش یا آزمایش</label>
                        <input type="file" name="images[]" id="images" class="form-control custom-file-input" multiple required>
                    </div>
                    <br>
                    <input class="btn" type="submit" value="افزودن آزمایش / گزارش ">
                </form>
                <br>
                <div class="back-box"><a href="{{$back}}">بازگشت</a></div>
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
