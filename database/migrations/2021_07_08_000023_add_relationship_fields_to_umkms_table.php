<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUmkmsTable extends Migration
{
    public function up()
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_detail_id');
            $table->foreign('contact_detail_id', 'contact_detail_fk_4334850')->references('id')->on('contact_details');
        });
    }
}
