@extends('layouts.app')
@section('title')
    {{ $customer->name }} | Customer Report
@endsection
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <h2 class="card-header fw-bold">Edit Customer: {{ $customer->name }}</h2>
            <div class="card-body">
                <form action="{{ route('customer.update', $customer) }}" method="POST">
                    @method('PUT')
                    <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control" placeholder="Customer Name"
                            id="customerName" value="{{ $customer->name }}">
                        <label for="customerName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="mobile" type="text" class="form-control" placeholder="Mobile"
                            id="customerMobile" value="{{ $customer->mobile }}">
                        <label for="customerMobile">Mobile</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea rows="10" name="address" id="customerAddress" class="form-control" placeholder="Address">{{ $customer->address }}</textarea>
                        <label for="customerAddress">Address</label>
                    </div>
                    @csrf
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
