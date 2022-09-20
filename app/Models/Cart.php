<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    public $items =[];
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item){
        $today = Carbon::now()->isoFormat('dddd');
        $price = $today === ('Sabtu' || 'Minggu') ? $item->price_weekend : $item->price_weekdays;
        $storedItem = ['quantity'=>1,'price'=>$price,'item'=>$item,'product_id'=>$item->id];

        for ($x=0; $x<=count($this->items);$x++){
            if(!array_key_exists($x, $this->items)){
                $item_id=$x;
                break;
            }
        }
        $this->items[$item_id]=$storedItem;
        $this->totalPrice += $price;
        $this->totalQuantity++;
    }

    public function remove($id){
        $this->totalPrice -= $this->items[$id]['item']['price'];
        unset($this->items[$id]);
        $this->totalQuantity--;
    }
}
