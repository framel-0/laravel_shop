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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->unsignedSmallInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('no action');
            $table->unsignedSmallInteger('unit_of_measure_id');
            $table->foreign('unit_of_measure_id')->references('id')->on('unit_of_measures')->onDelete('no action');
            $table->unsignedSmallInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('no action');
            $table->decimal('sale_price', 18, 4);
            $table->decimal('cost_price', 18, 4);
            $table->smallInteger('quantity');
            $table->timestamps();
            $table->UnsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('no action');
            $table->UnsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action');
            $table->UnsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
