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
        Schema::create('companies', function (Blueprint $table) {
            $table->id("id");
            $table->string("email", 255)->unique();
            $table->text("password")->comment("Sudah dalam bentuk enkripsi");
            $table->string("name", 255);
            $table->string("type", 255);
            $table->string("address", 255);
            $table->string("website", 255);
            $table->string("number", 255);
            $table->string("image", 255)->default('blank.png');
            $table->integer("saldo")->default(0);
            $table->timestamps(); // created_at dan updated_at
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
        Schema::dropIfExists('companies');
    }
};
