@extends('navbar')
@section('title','Home | E-Budgeting')
@section('home','active')
@section('home-page')
<div class="vh-100 d-flex mt-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card bg-white shadow-lg">
                    @if(session('success'))
                        <div class="alert alert-success alert-block dismissible show fade">
                            <div class="alert-body">
                                {{session('success')}}
                            </div>
                        </div>
                    @endif
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-2 text-uppercase ">Welcome to E-Budgeting!</h2>
                        <p class="mb-3"><i>"Website for managing finances"</i></p>
                        <hr>
                        <h5>Your Balance :</h5>
                        @if ($data->balance < 0)
                            <h2 class="text-danger">Rp {{ $data->value }} ,00</h2>
                        @elseif ($data->balance > 0)
                            <h2>Rp {{ $data->value }} ,00</h2>
                        @elseif ($data->balance === null || $data->balance == 0)
                            <h2>Rp 0 ,00</h2>
                        @endif
                        <br>
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <a href="transaction" class="text-decoration-none text-dark fs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                                    <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zm-2.5 0v7h-1.25V6zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2M.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1z"></path>
                                </svg>
                                Transaction
                            </a>
                            <span class="vertical-line" style="border-left: 1px solid #000; height: 35px;"></span>
                            <a href="history" class="text-decoration-none text-dark fs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg>
                                History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection