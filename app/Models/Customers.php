<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = ['name', 'mobile', 'address'];

    public function report() {
        return $this->hasMany('App\Models\DailyReport', 'customer_id');
    }

    public function paymentReport() {
        return $this->hasMany('App\Models\PaymentReport', 'customer_id');
    }
}
