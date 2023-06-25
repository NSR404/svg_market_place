<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Country extends Model
{
        protected $with = ['country_translations'];

        /**
         * Get the Zone that owns the Country
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function zone()
        {
            return $this->belongsTo(Zone::class);
        }



        public function country_translations(){
            return $this->hasMany(CountryTranslation::class);
        }

        public function getTranslation($field = '', $lang = false){
            $lang = $lang == false ? App::getLocale() : $lang;
            $country_translation = $this->country_translations->where('lang', $lang)->first();
            return $country_translation != null ? $country_translation->$field : $this->$field;
        }
}
