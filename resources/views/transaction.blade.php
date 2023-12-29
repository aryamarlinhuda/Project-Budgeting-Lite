@extends('navbar')
@section('title','Transaction | E-Budgeting')
@section('transaction','active')
@section('transaction-page')
<h1 class="m-3"><b>Transaction</b></h1>
<hr>
<form action="transaction/process" method="POST" class="col-md-6 m-auto" enctype="multipart/form-data">
    @csrf
    <div class="mt-3 mb-3">
        <label for="value" class="form-label fs-4">Value</label>
        <input type="number" class="form-control" id="value" name="value"/>
        @if ($errors->has('value'))
            <p class="text-danger fst-italic">{{ $errors->first('value') }}</p>
        @endif
    </div>
    <div class="mt-3 mb-3">
        <label for="flow" class="form-label fs-4">Flow</label>
        <select class="form-select" aria-label="Default select example" name="flow" id="flow">
            <option value=null selected disabled class="text-secondary">>>> Select Category <<<</option>
            <option value="income" class="bg-success text-white">Income</option>
            <option value="expense" class="bg-danger text-white">Expense</option>
        </select>
        @if ($errors->has('flow'))
            <p class="text-danger fst-italic">{{ $errors->first('flow') }}</p>
        @endif
    </div>
    <div class="mt-3 mb-3">
        <label for="note" class="form-label fs-4">Note</label>
        <textarea name="note" class="form-control" id="note" cols="5" rows="5"></textarea>
        <p class="text-secondary"><i>*May not be filled in</i></p>
        @if ($errors->has('note'))
            <p class="text-danger fst-italic">{{ $errors->first('note') }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection