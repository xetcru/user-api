<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersExOrderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers_ex_order_types', function (Blueprint $table) {
            $table->foreignId('worker_id')->constrained('workers')->onDelete('cascade');
            $table->foreignId('order_type_id')->constrained('order_types')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['worker_id', 'order_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers_ex_order_types');
    }
}
