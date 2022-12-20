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
        Schema::create('users', function (Blueprint $table) {
            $table->id("id");
            $table->string("email", 255)->unique();
            $table->text("password")->comment("Sudah dalam bentuk enkripsi");
            $table->date("dob");
            $table->string("first_name", 255);
            $table->string("last_name", 255);
            $table->string("number", 255);
            $table->string("image", 255)->default('blank.png');
            $table->string("cv", 255)->default('');
            $table->string("gender", 1)->comment("L laki, P perempuan");
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
        Schema::dropIfExists('users');
    }
};
