<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//belongsTo : https://laravel.com/docs/5.6/eloquent-relationships#updating-belongs-to-relationships
class Bill extends Model
{
    protected $table = "bills";

    public function bill_detail() {
        return $this->hasMany('App\Bill_Detail','id_bill','id');
    }

    public function bill() {
        return $this->belongsTo('App\Customer','id_customer','id');
    }
}
