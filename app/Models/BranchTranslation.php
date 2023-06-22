<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchTranslation extends Model
{
    use HasFactory;

    protected $fillable  = ['branch_id'  , 'lang' , 'name' , 'address'];


    public function  branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

}
