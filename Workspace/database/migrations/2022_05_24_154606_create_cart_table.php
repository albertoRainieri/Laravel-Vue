<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;


class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Cart::TABLE, function (Blueprint $table) {
            $table->unsignedBigInteger(Cart::USER_ID);
            $table->unsignedBigInteger(Cart::PRODUCT_ID);

            $table->foreign('user_id')->references(User::USER_ID)->on(User::USER_TABLE)
                ->onDelete('cascade');
            $table->foreign('product_id')->references(Product::PRODUCT_ID)->on(Product::PRODUCT_TABLE)
                ->onDelete('cascade');

            //$table->timestamps();
            $table->primary(['user_id', 'product_id']);
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
