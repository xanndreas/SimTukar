<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContactDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_details', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_icon_id');
            $table->foreign('contact_icon_id', 'contact_icon_fk_4334757')->references('id')->on('contact_icons');
        });
    }
}
