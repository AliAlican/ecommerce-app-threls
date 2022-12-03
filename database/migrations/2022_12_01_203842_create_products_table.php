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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('product_name');
            $table->string('brand'); // Normally brand should be a seperate table with a foreign key to here, but since application does not require that, and we are sure that this app will not expand in the future i put it here, also since no relations this will work faster.
            $table->unsignedFloat('price'); // i will store price as float without the Euro symbol, if needed in the future price symbol can be added as seperate column or it can be converted in the model as attribute

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
        Schema::dropIfExists('products');
    }
};
