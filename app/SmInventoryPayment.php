<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmInventoryPayment extends Model
{
    public function paymentMethods(){
    	return $this->belongsTo('App\SmPaymentMethhod', 'payment_method', 'id');
    }
    public  static function itemPaymentdetails($item_receive_id){
    	$itemPaymentdetails = SmInventoryPayment::where('item_receive_sell_id', '=', $item_receive_id)->get();
    	return count($itemPaymentdetails);
    }
}
