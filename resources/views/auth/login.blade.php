<!DOCTYPE html>
{{--
 @Author: Anwarul
 @Date: 2025-11-17 15:04:07
 @LastEditors: Anwarul
 @LastEditTime: 2025-11-17 16:25:24
 @Description: Innova IT
 --}}
<html lang="en">
<head>
    <title>LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <link type="text/css" rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css')}}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css')}}">

</head>
<body id="top">
<div class="page_loader"></div>


    <div class="login-32">
        <div class="login-32-inner">
            <div class="container">
                <form class="form-horizontal mt-3" action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-section">
                            <div class="logo">

                                    <a href="{{ route('home') }}" class="auth-logo">
                                        <h2>Default Template</h2>
                                    </a>

                            </div>
                            <div class="btn-section">
                                <a href="{{ url('admin/login') }}" class="link-btn active">Admin Login</a>
                                {{-- <a href="{{ route('register') }}" class="link-btn">Register</a> --}}
                            </div>
                            <div class="login-inner-form">
                                <form action="#" method="GET">
                                    <div class="form-group form-box">
                                        <input type="email"class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email"  required autofocus placeholder="Email Address" aria-label="Email Address">
                                        @error('email')
                                        <small class="text-danger"><i class="fa fa-dot-circle" style="font-size: 8px;"></i>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group form-box">
                                        <input type="password" name="password" required autofocus class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                        @error('password')
                                        <small class="text-danger"><i class="fa fa-dot-circle" style="font-size: 8px;"></i>{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group form-box checkbox clearfix">
                                        <div class="form-check checkbox-theme">
                                            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">
                                                Remember me
                                            </label>
                                        </div>
{{--                                        @if (Route::has('password.request'))--}}
{{--                                        <a href="{{ route('password.request') }}">Forgot Password</a>--}}
{{--                                        @endif--}}
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn-md btn-theme w-100">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
