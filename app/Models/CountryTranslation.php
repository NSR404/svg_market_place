<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CountryTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'name'      ,
        'lang'
    ];

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class , 'country_id');
    }
}
