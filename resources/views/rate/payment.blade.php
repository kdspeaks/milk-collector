@extends('layouts.app')
@section('title')
    Payment Reports
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Report List</div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Till Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Paid On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td><a
                                                href="{{ route('customer.show', $payment->customer) }}">{{ $payment->customer->name }}</a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($payment->till_date)->format('d/m/Y') }}</td>
                                        <td>₹ {{ $payment->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </table>
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add New Rate</div>
                    <div class="card-body">
                        <form action="{{ route('payment.store') }}" method="POST">
                            <div class="mb-3">
                                <label for="select-customer" class="form-label">Customer</label>
                                <select name="customer" class="form-select" id="select-customer">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="till_date" class="form-label">Payment Upto</label>
                                <input type="date" name="till_date" id="till_date" class="form-control"
                                    placeholder="Payment Upto">
                            </div>
                            <div class="mb-2">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control"
                                    placeholder="Enter Amount">
                            </div>
                            @csrf
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRate" tabindex="-1" aria-labelledby="editRateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRateLabel">Edit Rate For Fat <span id="fatNo">3.0</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editRate">
                        @method('PUT')
                        <div class="mb-2 form-floating">
                            <input type="text" id="fat" name="fat" class="form-control" placeholder="Fat">
                            <label for="fat">Fat</label>
                        </div>
                        <div class="mb-2 form-floating">
                            <input type="text" id="snf" name="snf" class="form-control" placeholder="SNF">
                            <label for="snf">SNF</label>
                        </div>
                        <div class="mb-2 form-floating">
                            <input type="text" id="rate" name="rate" class="form-control" placeholder="₹ Rate">
                            <label for="rate">₹ Rate</label>
                        </div>
                        @csrf
                        <div class="d-grid gap-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const config = {
            search: true, // Toggle search feature. Default: false
            creatable: false, // Creatable selection. Default: false
            clearable: false, // Clearable selection. Default: false
            maxHeight: '360px', // Max height for showing scrollbar. Default: 360px
            size: '', // Can be "sm" or "lg". Default ''
        }
        dselect(document.querySelector('#select-customer'), config)
    </script>
@endsection
