<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('name', 300);
            $table->string('description', 300);
            $table->string('regex', 300);

            $table->string('os', 300);
            $table->integer('cpu');
            $table->integer('ram');
            $table->integer('hdd');

            $table->boolean('networking');
            $table->string('networking_mask', 300);
            $table->string('networking_gateway', 300);
            $table->string('networking_dns', 300);

            $table->string('local_accounts_name', 300);
            $table->boolean('local_accounts_admin');
            $table->boolean('local_accounts_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
