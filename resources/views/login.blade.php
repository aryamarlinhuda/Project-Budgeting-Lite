@extends('component')
@section('title','Login Page | E-Budgeting')
@section('login')
<style>
    body {
        background-color: #60b7ff
    }
</style>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-white shadow-lg">
                    <div class="card-body p-5">
                        @if(session('auth'))
                        <div class="alert alert-danger alert-block dismissible show fade">
                            <div class="alert-body">
                                {{session('auth')}}
                            </div>
                        </div>
                        @endif
                        @if(session('register'))
                        <div class="alert alert-success alert-block dismissible show fade">
                            <div class="alert-body">
                                {{session('register')}}
                            </div>
                        </div>
                        @endif
                        @if(session('logout'))
                        <div class="alert alert-success alert-block dismissible show fade">
                            <div class="alert-body">
                                {{session('logout')}}
                            </div>
                        </div>
                        @endif
                        <h2 class="fw-bold mb-2 text-uppercase ">E-Budgeting</h2>
                        <p class="mb-3">Please enter your phone number or email and password!</p>
                        <form action="{{ url('login') }}" method="POST" class="mb-3 mt-md-4">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label ">Email or Phone Number</label>
                                <input type="text" class="form-control" name="email_or_phone" placeholder="name@example.com or 081*********" value="{{ session('email_or_phone') }}">
                                @if ($errors->has('email_or_phone'))
                                    <p class="text-danger fst-italic">{{ $errors->first('email_or_phone') }}</p>
                                @endif
                                @if(session('not_found'))
                                    <p class="text-danger fst-italic">{{session('not_found')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label ">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="******" value="{{ session('password') }}">
                                @if ($errors->has('password'))
                                    <p class="text-danger fst-italic">{{ $errors->first('password') }}</p>
                                @endif
                                @if(session('error'))
                                    <p class="text-danger fst-italic">{{session('error')}}</p>
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Login</button>
                                <br>
                                <a href="register" class="text-secondary"><i>Don't Have Account? Register Here.</i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection