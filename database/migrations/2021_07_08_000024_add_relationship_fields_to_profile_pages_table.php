<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProfilePagesTable extends Migration
{
    public function up()
    {
        Schema::table('profile_pages', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_type_id');
            $table->foreign('profile_type_id', 'profile_type_fk_4334726')->references('id')->on('profile_types');
        });
    }
}
