@extends('layouts.guest')
@section('title')
    Verify Email
@endsection
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6 mt-4 mx-auto">
                <div class="card">
                    <div class="card-body shadow-lg rounded">
                        <p class="card-text p-4">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <p class="card-text">
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                            </p>
                        @endif
                    </div>

                    <div class="card-footer">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button class="btn btn-primary" type="submit">Resend Verification Email</button>
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
