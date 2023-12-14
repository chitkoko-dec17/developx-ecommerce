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
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->unsignedInteger('quantity')->default(10);
            $table->string('description',500)->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('billing_first_name', 100)->after('billing_email');
            $table->string('billing_last_name', 100)->after('billing_first_name');
            $table->string('billing_company_name', 100)->after('billing_last_name')->nullable();
            $table->string('billing_address_2', 100)->after('billing_address')->nullable();
            $table->string('shipping_first_name', 100)->after('shipping_email');
            $table->string('shipping_last_name', 100)->after('shipping_first_name');
            $table->string('shipping_company_name', 100)->after('shipping_last_name')->nullable();
            $table->string('shipping_address_2', 100)->after('shipping_address')->nullable();
            $table->string('order_note', 100)->after('tracking_code')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('min_quantity')->after('quantity')->nullable();
            $table->string('status', 10)->after('min_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('billing_first_name');
            $table->dropColumn('billing_last_name');
            $table->dropColumn('billing_company_name');
            $table->dropColumn('billing_address_2');
            $table->dropColumn('shipping_first_name');
            $table->dropColumn('shipping_last_name');
            $table->dropColumn('shipping_company_name');
            $table->dropColumn('shipping_address_2');
            $table->dropColumn('order_note');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('min_quantity');
            $table->dropColumn('status');
        });
    }
};
