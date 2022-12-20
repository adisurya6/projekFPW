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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id("id");
            $table->string("title", 255);
            $table->string("description", 800);
            $table->integer("min");
            $table->integer("max");
            $table->string("location", 255);
            $table->integer("type_id");
            $table->integer("company_id");
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
        Schema::dropIfExists('jobs');
    }
};
