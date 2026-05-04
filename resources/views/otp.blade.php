<?php $page = 'otp'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="login-content">
        <div class="row">
            <!-- Login Banner -->
            <div class="col-lg-6 login-bg d-none d-lg-flex">
                <div class="login-carousel">
                    <div>
                        <div class="login-carousel-section mb-3">
                            <div class="login-banner">
                                <img src="{{URL::asset('build/img/auth/auth-1.svg')}}" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h3 class="mb-2">Welcome to <br>Dreams<span class="text-secondary">LMS</span> Courses.</h3>
                                <p>Platform designed to help organizations, educators, and learners manage, deliver, and track learning and training activities.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="login-carousel-section mb-3">
                            <div class="login-banner">
                                <img src="{{URL::asset('build/img/auth/auth-1.svg')}}" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h3 class="mb-2">Welcome to <br>Dreams<span class="text-secondary">LMS</span> Courses.</h3>
                                <p>Platform designed to help organizations, educators, and learners manage, deliver, and track learning and training activities.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="login-carousel-section mb-3">
                            <div class="login-banner">
                                <img src="{{URL::asset('build/img/auth/auth-1.svg')}}" class="img-fluid" alt="Logo">
                            </div>
                            <div class="mentor-course text-center">
                                <h3 class="mb-2">Welcome to <br>Dreams<span class="text-secondary">LMS</span> Courses.</h3>
                                <p>Platform designed to help organizations, educators, and learners manage, deliver, and track learning and training activities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Login Banner -->

            <div class="col-lg-6 login-wrap-bg">
                <!-- Login -->
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between login-header">
                                <img src="{{URL::asset('build/img/bisolpin-logo.png')}}" class="img-fluid" alt="Logo">
                                <a href="{{url('index')}}" class="link-1">Back to Home</a>
                            </div>
                            <div class="topic">
                                <h1 class="fs-32 fw-bold mb-3">Email OTP</h1>
                                <p class="fs-14 fw-normal mb-3">OTP sent to your Email Address ending ******doe@example.com</p>
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if(session('info'))
                                    <div class="alert alert-info">{{ session('info') }}</div>
                                @endif
                            </div>
                            <form action="{{route('otp.verify')}}" method="POST" class="mb-3 pb-3">
                                @csrf
                                <div class="d-flex align-items-center mb-3">
                                    <input type="text" name="otp1" class="form-control otp" maxlength="1" required>
                                    <input type="text" name="otp2" class="form-control otp" maxlength="1" required>
                                    <input type="text" name="otp3" class="form-control otp" maxlength="1" required>
                                    <input type="text" name="otp4" class="form-control otp" maxlength="1" required>
                                    <input type="text" name="otp5" class="form-control otp" maxlength="1" required>
                                    <input type="text" name="otp6" class="form-control otp" maxlength="1" required>
                                </div>
                                <div class="timer-cover d-flex align-items-center justify-content-center">
                                    <div class="badge badge-soft-danger rounded-pill d-flex align-items-center"><i class="isax isax-clock me-1"></i><span id="otp_timer">09:59</span> <span class="ms-1">s</span></div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-secondary btn-lg w-100" type="submit">Verify & Proceed<i class="isax isax-arrow-right-3 ms-1"></i></button>
                                </div>
                            </form>

                            <div class="fs-14 fw-normal d-flex align-items-center justify-content-center">
                                Didn’t get the OTP?
                                <form action="{{route('otp.resend')}}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link link-2 ms-1 p-0"> Resend OTP</button>
                                </form>
                            </div>

                            <!-- /Login -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection