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
        Schema::create('content_type_products', function (Blueprint $table) {
            $table->id();
            $table->string('field_name_value')->nullable()->default(null);
            $table->decimal('field_price_value')->default(0);
            $table->string('field_okdp_value')->unique();
            $table->string('field_alias_value')->unique();
            $table->boolean('visibility')->default(0);
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
        Schema::dropIfExists('content_type_products');
    }
};
