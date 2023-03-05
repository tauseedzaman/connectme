@extends('layouts.guest')
@section('title')
    Verify Phone
@endsection
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 mt-4 mx-auto">
                <div class="card">
                    <div class="card-body shadow-lg rounded">
                        <p class="card-text p-4">
                            {{ __('Thanks for signing up! Before getting started, could you verify your phone number by entering the OTP that we just send to you? If you didn\'t receive the SMS, we will gladly send you another.') }}
                        </p>

                        @if (session('message') == 'invalid-otp')
                            <p class="card-text p-4 text-danger">
                                {{ 'The OTP you entered is not valid, please try again' }}
                            </p>
                        @endif
                        @if (session('status') == 'verification-link-sent')
                            <p class="card-text">
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new OTP has been sent to the Mobile Number you provided during registration.') }}
                            </div>
                            </p>
                        @endif
                    </div>
                    <form class="mt-2" method="POST" action="{{ route('phone.verification.verify') }}">
                        @csrf
                        <div class="form-group">
                            <label for="my-input">Enter OTP</label>
                            <input id="my-input" class="form-control" placeholder="Enter OTP" type="number"
                                name="otp">
                        </div>

                        <button type="submit" class="btn btn-success">
                            {{ __('Verify') }}
                        </button>
                    </form>

                    <div class="card-footer">
                        <form method="POST" action="{{ route('phone.verification.send') }}">
                            @csrf

                            <button class="btn btn-primary" type="submit">Resend Verification OTP</button>
                        </form>

                        <form class="mt-2" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-danger">
                                {{ __('Log Out') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
