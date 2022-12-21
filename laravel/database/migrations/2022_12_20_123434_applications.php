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
        Schema::create('applications', function (Blueprint $table) {
            $table->id("id");
            $table->integer("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->integer("Job_id")->references('id')->on('jobs')->onDelete('cascade');
            $table->integer("status")->default(0);
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
