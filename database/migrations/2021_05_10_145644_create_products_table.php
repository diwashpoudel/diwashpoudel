<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories','id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained('categories','id')->cascadeOnUpdate()->nullOnDelete();
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->float('price');
            $table->float('discount')->nullable();
            $table->boolean('featured')->default(false);
            $table->foreignId('brand_id')->nullable()->constrained('brands','id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained('users','id')->cascadeOnUpdate()->nullOnDelete();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->foreignId('created_by')->nullable()->constrained('users','id')->cascadeOnUpdate()->nullOnDelete();
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
}
