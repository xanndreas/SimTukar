<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPagesTable extends Migration
{
    public function up()
    {
        Schema::create('news_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('views')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
