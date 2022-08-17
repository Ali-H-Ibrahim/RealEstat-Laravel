<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
            'user_id',
            'town_id',
             'type',
             'for_sell',
             'for_rent',
             'duration_of_rent',
             'main_image',
             'secondary_image' ,
             'price',
             'area' ,
             'number_of_rooms',
             'number_of_bathrooms' ,
             'phone_subscription' ,
             'net_subscription',
             'dimension_of_the_city',
             'dimension_of_the_school',
             'dimension_of_the_market',
             'owner_description',
             'sold_rented',
             'status',

        ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function towns()
    {
        return $this->belongsTo(Town::class);
    }

    public function getStatus() { return $this->status == 'On' ? "Active" : "In-Active"; }

}
