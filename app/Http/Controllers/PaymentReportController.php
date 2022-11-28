<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\PaymentReport;
use Illuminate\Http\Request;

class PaymentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rate.payment', [
            'payments' => PaymentReport::paginate(20),
            'customers' => Customers::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customers::find($request->customer);
        PaymentReport::create([
            'till_date' => $request->till_date,
            'amount' => $request->amount,
            'customer_id' => $request->customer
        ]);

        $customer->due_amount = $customer->due_amount - $request->amount;
        $customer->save();

        return redirect()->back()->with('message', 'Payment information has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentReport  $paymentReport
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentReport $paymentReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentReport  $paymentReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentReport $paymentReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentReport  $paymentReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentReport $paymentReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentReport  $paymentReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentReport $paymentReport)
    {
        //
    }
}
