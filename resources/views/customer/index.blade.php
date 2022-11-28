@extends('layouts.app')
@section('title')
    Customers
@endsection
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-5 mb-2">
                <div class="card">
                    <div class="card-header">{{ __('Customer List') }}</div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($customers as $customer)
                                <li class="list-group-item d-flex align-items-center">
                                    <div>
                                        <strong>{{ $customer->name }}</strong><br>
                                        <small><strong>Mob:</strong> {{ $customer->mobile }}</small>
                                        <div class="vr"></div>
                                        Due: <strong>₹ {{ $customer->due_amount }}</strong>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="d-flex">
                                            <a href="{{ route('customer.show', $customer) }}" class="btn btn-sm btn-success me-1"><i data-feather="eye"
                                                    width="14px" height="14px"></i></a>
                                            <a href="{{ route('customer.edit', $customer) }}" class="btn btn-sm btn-primary"><i data-feather="edit"
                                                    width="14px" height="14px"></i></a>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p>No customers available! Why not add one?</p>
                            @endforelse
                        </ul>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">{{ __('Add New Customer') }}</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Customer Name"
                                    id="customerName">
                                <label for="customerName">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="mobile" type="text" class="form-control" placeholder="Mobile"
                                    id="customerMobile">
                                <label for="customerMobile">Mobile</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea rows="10" name="address" id="customerAddress" class="form-control" placeholder="Address"></textarea>
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
        </div>
    </div>
@endsection
