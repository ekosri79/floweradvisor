<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('prod_code',10);
            $table->string('prod_name',50);
            $table->string('prod_desc',550);
            $table->string('prod_detail',550);
            $table->string('prod_care',550);
            $table->string('prod_pic',100);
            $table->string('prod_parse',30);
            $table->tinyInteger('currency')->default(1);
            $table->decimal('price',$precision = 12, $scale = 2)->default(1);
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
        Schema::dropIfExists('product');
    }
}
