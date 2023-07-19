<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['set_default' , 'name'];


    ##### START GETTER/SETTER #######
    public function getPhoneAttribute()
    {
        return "+{$this->attributes['phone_country_code']} {$this->attributes['phone']}";
    }
    ##### END GETTER/SETTER #######


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
