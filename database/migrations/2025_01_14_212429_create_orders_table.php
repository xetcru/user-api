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
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('partnership_id');
            $table->unsignedBigInteger('user_id');  // Менеджер, создавший заказ
            $table->text('description');
            $table->date('date');
            $table->string('address');
            $table->decimal('amount', 10, 2);  // Сумма заказа
            $table->enum('status', ['created', 'assigned', 'completed']);  // Статус заказа
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->foreign('partnership_id')->references('id')->on('partnerships')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
