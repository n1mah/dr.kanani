<x-panel.layouts.header />
    <div id="main">
        <x-panel.aside />
        <div class="body">
            <x-panel.header-body />
            <hr>
            <div id="insurances-page">
                <h1>بیمه ها</h1>
                <br>
                <div class="add-box">
                    <a href="{{route("insurance.addForm")}}">افزودن بیمه جدید</a>
                </div>
                <br>
                <hr>
                <br>
                <h3>جستجو</h3>
                <br>
                <form action="{{route("insurances.search")}}" method="post" class="search-box">
                    @csrf
                    @method("post")
                    <label for="search">عنوان بیمه :</label>
                    <input type="search" id="search" name="search" placeholder="عنوان را وارد کنید ...">
                    <input type="submit" id="search_btn" value="جستجو">
                    <span class="split"></span>
                    <a href="{{route("insurances")}}">نمایش همه</a>
                </form>
                <br>
                <hr>
                <br>
                <div class="table">
                    <table>
                        <thead>
                        <tr>
                            <th>شماره</th>
                            <th>عنوان بیمه</th>
                            <th>مبلغ ویزیت</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($insurances as $insurance)
                        <tr>
                            <td>{{$insurance->id}}</td>
                            <td>{{$insurance->title}}</td>
                            <td class="money">{{number_format((String)$insurance->fee)}}</td>
                            <td>
                                <form action="{{route("insurance.editForm",$insurance)}}" method="get">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$insurance->id}}">
                                    <button class=" btn_up">ویرایش</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route("insurance.delete",$insurance)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn_del">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <x-panel.pagination :lists="$insurances" />
                </div>
            </div>
        </div>
    </div>

<x-panel.layouts.footer />
