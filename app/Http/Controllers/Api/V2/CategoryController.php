<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\CategoryCollection;
use App\Http\Resources\V2\CategoryWithProductsCollection;
use App\Models\BusinessSetting;
use App\Models\Category;
use App\Models\Product;
use Cache;

class CategoryController extends Controller
{

    public function index($parent_id = 0)
    {
        if(request()->has('parent_id') && is_numeric (request()->get('parent_id'))){
          $parent_id = request()->get('parent_id');
        }

        return Cache::remember("app.categories-$parent_id", 86400, function() use ($parent_id){
            return new CategoryCollection(Category::where('parent_id', $parent_id)->get());
        });
    }

    public function featured()
    {
        $home_categories_ids = json_decode(get_setting('home_categories'));

        return Cache::remember('app.featured_categories', 86400, function() use($home_categories_ids) {
            return new CategoryCollection(Category::query()->whereIn('id' , $home_categories_ids)->orderByDesc('order_level')->get());
        });
    }


    function featuredProducts() {
        $home_categories_ids = json_decode(get_setting('home_categories'));
        $featured_categories_with_products=Category::query()->whereIn('id' , $home_categories_ids)
        ->with(['products'=>function($q){
            $q->physical()->where('published',1)->where('approved',1);
        }])->orderByDesc('order_level')->get();
        return new CategoryWithProductsCollection($featured_categories_with_products);
        // ->map(function ($category) {
        //     $category->products = $category->products->take(6);
        //     return $category;
        // });

        // ->with(['products',function($q){
        //     $q->physical()->where('published',1)->where('approved',1)->get()->take(6);

        // }])
        // $featured_categories_products=Product::physical()->where('published',1)->where('approved',1)->whereIn('category_id',$featured_categories_ids)->get()->groupBy('category_id')->map(function($category) {
        //     return $category->take(6);
        // });
        // dd($featured_categories_products);
        return response()->json($featured_categories_with_products, 200);



    }



    public function home()
    {
        return Cache::remember('app.home_categories', 86400, function(){
            return new CategoryCollection(Category::whereIn('id', json_decode(get_setting('home_categories')))->get());
        });
    }

    public function top()
    {
        return Cache::remember('app.top_categories', 86400, function(){
            return new CategoryCollection(Category::whereIn('id', json_decode(get_setting('home_categories')))->limit(20)->get());
        });
    }
}
