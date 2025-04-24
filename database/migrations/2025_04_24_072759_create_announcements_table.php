<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('text');
            $table->string('link')->nullable();
            $table->tinyInteger('status')->nullable()->default(0); // 0 = Inactive, 1 = Active
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
