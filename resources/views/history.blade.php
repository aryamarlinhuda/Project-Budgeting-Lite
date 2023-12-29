@extends('navbar')
@section('title','History | E-Budgeting')
@section('history','active')
@section('history-page')
<h1 class="m-3"><b>Transaction History</b></h1>
<hr>
<div class="container mt-4">
    <ul class="list-group mt-3">
        @foreach ($data as $index => $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0">{{ $item->created_at }}</h6>
                @if ($item->note === null)
                    <small>-</small>
                @else
                    <small>{{ $item->note }}</small>
                @endif
            </div>
            @if ($item->flow === "income")
                <span class="badge bg-success fs-5">+ Rp {{ $item->balance }} ,00</span>
            @else
                <span class="badge bg-danger fs-5">- Rp {{ $item->balance }} ,00</span>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@if(count($data) === 0)
    <h4 class="text-center text-secondary"><i><b>There is No Transaction yet!</b></i></h4>
@endif
@endsection