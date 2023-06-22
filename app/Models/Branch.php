<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Branch extends Model
{
    use HasFactory;

    protected $fillable  = ['name' , 'address' , 'emails' , 'phone_numbers' , 'google_map'];
    protected $with = ['branch_translations'];


    public function branch_translations(){
        return $this->hasMany(BranchTranslation::class);
    }



    public function getTranslation($field = '', $lang = false){
        $lang = $lang == false ? App::getLocale() : $lang;
        $branch_translation = $this->branch_translations->where('lang', $lang)->first();
        return $branch_translation != null ? $branch_translation->$field : $this->$field;
    }

    public function getPhoneNumbersAttribute()
    {
        return json_decode($this->attributes['phone_numbers'] , true);
    }
    public function getEmailsAttribute()
    {
        return json_decode($this->attributes['emails'] , true);
    }


}
