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
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card mb-4">
            <h2 class="card-header fw-bold">{{ $customer->name }}</h2>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 d-flex">
                        <div class="hstack gap-3 align-items-center">
                            <div><strong>Mobile:</strong> {{ $customer->mobile }}</div>
                            <div class="vr"></div>
                            <div>{{ $customer->address }}</div>
                            <div class="vr"></div>
                            <a href="{{ route('customer.edit', $customer) }}" class="btn btn-primary btn-sm me-1"><i
                                    data-feather="edit" width="14px" height="14px"></i> Edit</a>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="ms-md-auto">
                            <span>Due Amount</span>
                            <h2 class="fw-bold">₹{{ $customer->due_amount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header fw-bold">Collection Report</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Fat</th>
                                <th scope="col">SNF</th>
                                <th scope="col">Water</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($report->for_date)->format('d/m/Y') }}</td>
                                    <td>{{ $report->time }}</td>
                                    <td>{{ $report->fat }}</td>
                                    <td>{{ $report->snf }}</td>
                                    <td>{{ $report->water }}</td>
                                    <td>₹{{ $report->rate }}</td>
                                    <td>{{ $report->qty }}</td>
                                    <td>₹{{ $report->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reports->links() }}
            </div>
        </div>
        <div class="row">
            <div class="col-md order-2 order-md-1">
                <div class="card">
                    <div class="card-header fw-bold">Payment Reports</div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Till Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Paid On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($payment->till_date)->format('d/m/Y') }}</td>
                                        <td>₹ {{ $payment->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md order-1 order-md-2 mb-4">
                <div class="card">
                    <div class="card-header fw-bold">New Payment</div>
                    <div class="card-body">
                        <form action="{{ route('payment.store') }}" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="till_date" class="form-label">Payment Upto</label>
                                    <input type="date" name="till_date" id="till_date" class="form-control"
                                        placeholder="Payment Upto">
                                </div>
                                <div class="col">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Enter Amount">
                                    <input type="hidden" name="customer" value="{{ $customer->id }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-2">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
