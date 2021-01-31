<?php

use App\Order;
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
            $table->string('fullname');
            $table->string('phone')->unique();
            $table->float('amount')->unsigned();
            $table->dateTime('created');
            $table->dateTime('call_date')->nullable();
            $table->enum('status', [Order::NEW_ORDER, Order::WAITING_FOR_CALL, Order::IN_PROGRESS, Order::ORDER_DONE]);
            $table->integer('manager_id')->unsigned();
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
