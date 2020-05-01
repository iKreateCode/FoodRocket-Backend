<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferItem extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id', 'item_id', 'price', 'quantity',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function item() {
        return $this->hasOne('App\MenuItem', 'id', 'item_id');
    }
}
