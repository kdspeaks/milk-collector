<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'for_date', 'time', 'fat', 'snf', 'rate', 'qty', 'amount', 'water'];

    public function customer() {
        return $this->belongsTo('App\Models\Customers');
    }
}
