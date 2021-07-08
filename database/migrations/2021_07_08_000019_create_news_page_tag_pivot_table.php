<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPageTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('news_page_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('news_page_id');
            $table->foreign('news_page_id', 'news_page_id_fk_4334961')->references('id')->on('news_pages')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_4334961')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
