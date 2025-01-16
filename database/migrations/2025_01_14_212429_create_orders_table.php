<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('order_types');
            $table->foreignId('partnership_id')->constrained('partnerships');
            $table->foreignId('user_id')->constrained('users');
            $table->text('description');
            $table->date('date');
            $table->string('address');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['created', 'assigned', 'completed']);
            //$table->enum('status', ['created', 'assigned', 'completed', 'in_progress']);
            $table->timestamps();

            $table->index(['type_id', 'partnership_id', 'user_id']);
            $table->index('status');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
