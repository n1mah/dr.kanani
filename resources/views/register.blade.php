<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset("fonts/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/form.css")}}">
</head>
<body>
    <div class="main">
        <div class="register">
            <h1>فرم ثبت نام</h1>
            <form action="{{route("register_process")}}" method="post">
                @csrf
                @method("post")
                <div class="row">
                    <label for="name">نام</label>
                    <input name="name" id="name" placeholder="نام خود را وارد کنید" required>
                </div>
                <br>
                <div class="row">
                    <label for="email">ایمیل</label>
                    <input type="email" name="email" id="email" placeholder="ایمیل خود را وارد کنید" required>
                </div>
                <br>
                <div class="row">
                    <label for="password">رمزعبور</label>
                    <input type="password" name="password" id="password" placeholder="رمزعبور خود را وارد کنید" required>
                </div>
                <br>
                <div class="row">
                    <input type="submit" value="ثبت نام">
                </div>
            </form>
            <a href="{{route("login")}}">لاگین</a>

        </div>
    </div>
    @if(Session::get('error') !== null)
        <div class="errors">
            <br>
            <p>{{Session::get('error')}}</p>
            <br>
        </div>
    @endif
    @if($errors->any())
        <div class="errors">
            @foreach($errors->all() as $error)
                <p>- {{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
