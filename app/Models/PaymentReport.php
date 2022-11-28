<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReport extends Model
{
    use HasFactory;

    protected $fillable = ['till_date', 'amount', 'customer_id'];

    public function customer() {
        return $this->belongsTo('App\Models\Customers');
    }
}
