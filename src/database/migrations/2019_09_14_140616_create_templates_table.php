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

        DB::table('templates')->insert(
            array(
                'name' => 'Maszyny produkcyjne',
                'description' => 'Maszyny uruchomione w środowisku produkcyjnym',
                'regex' => '/^.+\.prod\.orlen\.pl$/',
                'cpu' => 4,
                'ram' => 8,
                'hdd' => 200,
                'devices_mouse' => true,
                'devices_keyboard' => true,
                'os' => 'Windows 10',
                'os_version' => 'KB4506998',
                'firewall_enabled' => true,
                'lan_enabled' => true,
                'lan_mask' => '255.255.255.0',
                'lan_gateway' => '192.168.0.254',
                'lan_dns' => '8.8.8.8'
            )
        );

        // DB::table('templates')->insert(
        //     array(
        //         'name' => 'Maszyny testowe',
        //         'description' => 'Maszyny uruchomione w środowisku testowym',
        //         'regex' => '/^.+\.tst\.orlen\.pl$/',
        //         'cpu' => 8,
        //         'ram' => 32,
        //         'hdd' => 800,
        //     )
        // );
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
