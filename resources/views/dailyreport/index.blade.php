@extends('layouts.app')
@section('title')
    Daily Reports
@endsection
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-header">{{ __('Daily Reports') }}</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Customer</th>
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
                                            <td><a href="{{ route('customer.show', $report->customer->id) }}">{{ $report->customer->name }}</a></td>
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
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('New Daily Report') }}</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="select-customer" class="form-label">Customer</label>
                                <select name="customer" class="form-select" id="select-customer">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input name="date" type="date" class="form-control" placeholder="Date" id="date"
                                    value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="time" id="morning"
                                        value="Morning" {{ \Carbon\Carbon::now()->hour < 12 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="morning">Morning</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="time" id="evening"
                                        value="Evening" {{ \Carbon\Carbon::now()->hour < 12 ? '' : 'checked' }}>
                                    <label class="form-check-label" for="evening">Evening</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="select-fat" class="form-label">Fat</label>
                                <select class="form-select" id="select-fat">
                                    <option value="">Select Fat</option>
                                    @foreach ($rates as $rate)
                                        <option value="{{ $rate->rate }}">{{ $rate->fat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="fat" id="realFat">
                            <div class="mb-3">
                                <label for="snf" class="form-label">SNF</label>
                                <input name="snf" type="text" class="form-control" placeholder="Enter SNF" id="snf">
                            </div>
                            <div class="mb-3">
                                <label for="water" class="form-label">Water</label>
                                <input name="water" type="text" class="form-control" placeholder="Enter Water" id="water">
                            </div>
                            <div class="mb-3">
                                <label for="rate" class="form-label">Rate</label>
                                <input name="rate" type="text" class="form-control" placeholder="Enter Rate" id="rate">
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity</label>
                                <input name="qty" type="text" class="form-control" placeholder="Enter Quantity" id="qty">
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input name="amount" type="text" class="form-control" placeholder="Enter Amount" id="amount">
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
    <script>
        const config = {
            search: true, // Toggle search feature. Default: false
            creatable: false, // Creatable selection. Default: false
            clearable: false, // Clearable selection. Default: false
            maxHeight: '360px', // Max height for showing scrollbar. Default: 360px
            size: '', // Can be "sm" or "lg". Default ''
        }
        dselect(document.querySelector('#select-customer'), config)
        dselect(document.querySelector('#select-fat'), config)

        const fatEl = document.getElementById('select-fat')
        const realFatEl = document.getElementById('realFat')
        const rateEl = document.getElementById('rate')
        const qtyEl = document.getElementById('qty')
        let fat
        let rate
        fatEl.addEventListener('change', function() {
            fat = this.options[this.selectedIndex].text
            rate = this.value
            rateEl.value = rate
            realFatEl.value = fat
        })
        qtyEl.addEventListener('keyup', function(fat, rate) {
            let qty = this.value
            if(qty.length > 0) {
                qty = parseFloat(this.value)
                rate = parseFloat(rateEl.value)
                document.getElementById('amount').value = parseInt((rate * qty))
            } else {
                document.getElementById('amount').value = ''
            }
        })
    </script>
@endsection
