<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SvgOrder extends Model
{
    use HasFactory;

    protected $fillable =   [
        'user_id',
        'total',
        'type',
        'address_id',
        'code',
    ];


    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            self::generateRandomCode($model);
        });
    }




    /**
     * Generate Random "Unique" Code For Order
     */
    protected static function generateRandomCode($model)
    {
        $code               =   mt_rand(11111111 , 99999999);
        $is_duplicated      =   self::query()->whereCode($code)->exists();
        if($is_duplicated)
        {
            return self::generateRandomCode($model);
        }else{
            $model->code    =   $code;
        }
    }


    ############ START RELATIONS ##################

    /**
     * Each Svg Order Has many Products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'svg_order_products', 'svg_order_id', 'product_id')
                ->withPivot(['quantity' , 'variation']);
    }



    /**
     * Each Svg Order Belongs To One User
     */
    public function   user() : BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }




    /**
     * Each Svg Order Belongs To One Address
     */
    public function   address() : BelongsTo
    {
        return $this->belongsTo(Address::class , 'address_id');
    }






    ############ End  RELATIONS ##################


    public function getStatusAttributeInHtml()
    {
        $status     =   $this->attributes['status'];
        $html_class =   'warning';
        if($status  ==  'cancelled')
        {
            $html_class =   'danger';
        }elseif($status ==   'completed')
        {
            $html_class =   'success';
        }
        echo '<span class="text-'.$html_class.'">'.__('custom.'.$status).'</span>';
    }

}
