@extends('layouts.guest')
@section('title')
    Register
@endsection
@section('content')
        <?php
        $icons = new \Feather\IconManager();
        ?>
    <div class="preloader"></div>

    <div class="main-wrap">

        <div class="bg-transparent border-0 shadow-none nav-header">
            <div class="nav-top w-100">
                <a href="{{ url('/') }}"><i class=" text-success display1-size me-2 ms-0"> {!! $icons->getIcon('zap') !!}
                    </i><span
                        class="mb-0 text-current d-inline-block fredoka-font ls-3 fw-600 font-xxl logo-text">{{ config('app.name') }}
                    </span> </a>
                <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                        class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="default-video.html" class="mob-menu me-2"><i
                        class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <a href="#" class="me-2 menu-search-icon mob-menu"><i
                        class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
                <button class="nav-menu me-0 ms-2"></button>

                <a href="{{ route('login') }}"
                    class="p-3 text-center text-white header-btn d-none d-lg-block bg-dark fw-500 font-xsss ms-auto w100 lh-20 rounded-xl"
                    data-bs-toggle="modal" data-bs-target="#Modallogin">Login</a>
                <a href="{{ route('register') }}"
                    class="p-3 text-center text-white bg-current header-btn d-none d-lg-block fw-500 font-xsss ms-2 w100 lh-20 rounded-xl"
                    data-bs-toggle="modal" data-bs-target="#Modalregister">Register</a>

            </div>


        </div>

        <div class="row">
            <div class="p-0 bg-no-repeat col-xl-5 d-none d-xl-block vh-100 bg-image-cover"
                style="background-image: url(images/login-bg-2.jpg);"></div>
            <div class="overflow-scroll bg-white col-xl-7 vh-100 align-items-center d-flex rounded-3">
                <div class="border-0 shadow-none card ms-auto me-auto login-card">
                    <div class="text-left card-body rounded-0">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                        @endforeach
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <h2 class="my-4 fw-700 display1-size display2-md-size">Create <br>your account</h2>
                            @csrf

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <div class="mb-3 form-group icon-input">
                                <i class="font-sm text-grey-500 pe-0" value="{{ old('first_name') }}"
                                    style="margin-top: -10px">{!! $icons->getIcon('user') !!}
                                </i>
                                <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your first Name" required name="first_name">
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                            </div>


                            <div class="mb-3 form-group icon-input">
                                <i class="font-sm text-grey-500 pe-0" style="margin-top: -10px">{!! $icons->getIcon('user') !!}</i>
                                <input type="text" required name="last_name" value="{{ old('last_name') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Last Name">
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                            </div>
                            <div class="mb-3 form-group icon-input">
                                <i class="font-sm text-grey-500 pe-0" style="margin-top: -10px"> {!! $icons->getIcon('user') !!}</i>
                                <input type="text" required name="username" value="{{ old('username') }}"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Username">
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />

                            </div>

                            <nav class="mb-2 nav">
                                <li class="nav-item">
                                    <a class="mx-1 nav-link btn btn-info"
                                        onclick="toggle_email_and_phone_fields('email','Your Email Address')">Email</a>
                                </li>
                                <li class="nav-item">
                                    <a class="mx-1 nav-link btn btn-info"
                                        onclick="toggle_email_and_phone_fields('tel','Your Phone Number')">Phone</a>
                                </li>
                            </nav>

                            <div class="mb-3 form-group icon-input">
                                <i class="font-sm text-grey-500 pe-0" style="margin-top: -10px">{!! $icons->getIcon('user') !!}</i>
                                <input type="email" id="email" required name="email"
                                    class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                                    placeholder="Your Email Address">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <x-input-error :messages="$errors->get('tel')" class="mt-2" />

                                <script>
                                    function toggle_email_and_phone_fields(input_type, place_holder) {
                                        var element = document.querySelector("#email")
                                        element.type = input_type
                                        element.name = input_type
                                        element.placeholder = place_holder
                                    }
                                </script>
                            </div>

                            <div class="mb-3 custom-file form-group">
                                <input id="profile" class="custom-file-input" type="file" required name="profile">
                                <label for="profile" class="custom-file-label">Profile</label>
                                <x-input-error :messages="$errors->get('profile')" class="mt-2" />

                            </div>

                            <label for="">Gender</label><br>
                            <div class="mb-2 form-check form-check-inline">
                                <input id="gender" class="form-check-input" type="radio" required name="gender"
                                    value="male">
                                <label for="gender" class="form-check-label">Male</label>

                            </div>
                            <div class="mb-2 form-check form-check-inline">

                                <input id="gender" class="form-check-input" type="radio" required name="gender"
                                    value="female">
                                <label for="gender" class="form-check-label">Female</label>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />

                            </div>
                            <div class="mb-3 form-group icon-input">
                                <input type="Password" required name="password"
                                    class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Password">
                                <i class="font-sm text-grey-500 pe-0" style="margin-top: -10px">
                                    {!! $icons->getIcon('lock') !!}</i>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            </div>

                            <div class="mb-1 form-group icon-input">
                                <input type="Password" required name="password_confirmation"
                                    class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                                    placeholder="Confirm Password">
                                <i class="font-sm text-grey-500 pe-0" style="margin-top: -10px">{!! $icons->getIcon('lock') !!}
                                </i>
                            </div>
                            <div class="mb-3 text-left form-check">
                                <input type="checkbox" required name="terms" class="mt-2 form-check-input"
                                    id="exampleCheck2">
                                <label class="form-check-label font-xsss text-grey-500" for="exampleCheck2">Accept Term
                                    and Conditions</label>
                                <x-input-error :messages="$errors->get('terms')" class="mt-2" />

                                <!-- <a href="#" class="float-right mt-1 fw-600 font-xsss text-grey-700">Forgot your Password?</a> -->
                            </div>
                            <div class="mb-1 form-group"><button
                                    class="p-0 text-center text-white border-0 form-control style2-input fw-600 bg-dark ">Register</button>
                            </div>
                        </form>

                        <div class="p-0 text-left col-sm-12">

                            <h6 class="mt-0 mb-0 text-grey-500 font-xsss fw-500 lh-32">Already have account <a
                                    href="{{ route('login') }}" class="fw-700 ms-1">Login</a></h6>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
