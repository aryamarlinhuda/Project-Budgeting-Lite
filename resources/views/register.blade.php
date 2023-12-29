@extends('component')
@section('title','Registration Page | E-Budgeting')
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
                    <div class="card-body p-3">
                        <a href="/" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
                            </svg>
                            Back
                        </a>
                        <h2 class="fw-bold mb-2 text-uppercase ">Register Account</h2>
                        @if(session('auth'))
                        <div class="alert alert-danger alert-block dismissible show fade">
                            <div class="alert-body">
                                {{session('auth')}}
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
                        <form action="{{ url('register') }}" method="POST" class="mb-3 mt-md-4">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label ">Name</label>
                                <input type="name" class="form-control" name="name" placeholder="Enter your Name!">
                                @if ($errors->has('name'))
                                    <p class="text-danger fst-italic">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label ">Photo</label>
                                <input type="file" class="form-control" name="photo">
                                <span class="text-secondary"><i>*optional</i></span>
                                @if ($errors->has('photo'))
                                    <p class="text-danger fst-italic">{{ $errors->first('photo') }}</p>
                                @endif
                                @if(session('format'))
                                    <p class="text-danger fst-italic">{{session('format')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label ">Email or Phone Number</label>
                                <input type="name" class="form-control" name="email_or_phone" placeholder="name@example.com or 081*********">
                                @if ($errors->has('email_or_phone'))
                                    <p class="text-danger fst-italic">{{ $errors->first('email_or_phone') }}</p>
                                @endif
                                @if(session('registered'))
                                    <p class="text-danger fst-italic">{{session('registered')}}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label ">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="*******">
                                @if ($errors->has('password'))
                                    <p class="text-danger fst-italic">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label ">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="*******">
                                @if ($errors->has('confirm_password'))
                                    <p class="text-danger fst-italic">{{ $errors->first('confirm_password') }}</p>
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection