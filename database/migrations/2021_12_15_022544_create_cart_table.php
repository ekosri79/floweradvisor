<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('coupon',30);
            $table->decimal('subtotal',$precision = 12, $scale = 2)->default(0);
            $table->decimal('discount',$precision = 12, $scale = 2)->default(0);
            $table->decimal('delivery',$precision = 12, $scale = 2)->default(0);
            $table->decimal('total',$precision = 12, $scale = 2)->default(0);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
