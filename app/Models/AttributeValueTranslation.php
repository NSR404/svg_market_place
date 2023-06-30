<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeValueTranslation extends Model
{
    use HasFactory;

    protected $fillable     =   ['attribute_value_id'   , 'lang' , 'value'];

    public function attributeValue() : BelongsTo
    {
        return $this->belongsTo(AttributeValue::class , 'attribute_value_id');
    }
}
