<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkstationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workstations', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('FQDN', 300);

            // WARNING !!!
            // Code below is completly against the very idea of migrations
            // It was written only to save time
            // Please! Do not deploy this to production!
            foreach(\App\Workstation::params() as $param => $options){
                if($options['type'] == 'number')
                    $table->integer($param)->default(0);

                if($options['type'] == 'boolean')
                    $table->boolean($param)->default(false);

                if($options['type'] == 'text')
                    $table->string($param, 300)->default('');
                
                if($options['type'] == 'textarea')
                    $table->string($param, 600)->default('');
            }
        });

        DB::table('workstations')->insert(
            array(
                'FQDN' => 'wm1.prod.orlen.pl',
                'cpu' => 2,
                'ram' => 8,
                'hdd' => 250,
            )
        );

        DB::table('workstations')->insert(
            array(
                'FQDN' => 'orlen.net',
                'cpu' => 32,
                'ram' => 256,
                'hdd' => 8000,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workstations');
    }
}
