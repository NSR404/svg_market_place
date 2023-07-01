<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('svg_order_products', function (Blueprint $table) {
            $table->integer('quantity')->after('svg_order_id')->default(1);
            $table->text('variation')->after('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('svg_order_products', function (Blueprint $table) {
            $table->dropColumn(['quantity' , 'variation']);
        });
    }
};
