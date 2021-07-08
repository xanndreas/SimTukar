<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAgendasTable extends Migration
{
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id', 'organization_fk_4339488')->references('id')->on('organizations');
        });
    }
}
