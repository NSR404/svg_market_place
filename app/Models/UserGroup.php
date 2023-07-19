<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users() : HasMany
    {
        return $this->hasMany(UserEmail::class  , 'group_id');
    }
}
