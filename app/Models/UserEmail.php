<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEmail extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'email' , 'group_id'];

    public function group() : BelongsTo
    {
        return $this->belongsTo(UserGroup::class , 'group_id');
    }
}
