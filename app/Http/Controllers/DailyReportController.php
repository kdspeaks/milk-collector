<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DailyReport;
use App\Models\Rate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailyReport = DailyReport::paginate(20);
        $customers = Customers::all(['id', 'name']);
        $rates = Rate::all();
        return view('dailyreport.index', [
            'reports' => $dailyReport,
            'customers' => $customers,
            'rates' => $rates
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
        DailyReport::create([
            'customer_id' => $request->customer,
            'for_date' => $request->date,
            'time' => $request->time,
            'fat' => $request->fat,
            'snf' => $request->snf,
            'rate' => $request->rate,
            'qty' => $request->qty,
            'amount' => $request->amount,
            'water' => $request->water,
        ]);

        $customer = Customers::find($request->customer);
        $customer->due_amount = $customer->due_amount + $request->amount;
        $customer->save();
        return redirect('/daily-report')->with('message', 'New report has been added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
