<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4334976')->references('id')->on('users');
            $table->unsignedBigInteger('berita_id')->nullable();
            $table->foreign('berita_id', 'berita_fk_4334980')->references('id')->on('news_pages');
        });
    }
}
