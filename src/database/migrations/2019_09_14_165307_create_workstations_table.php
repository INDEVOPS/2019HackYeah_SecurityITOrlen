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
                'FQDN' => 'wm2.prod.orlen.pl',
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

        DB::table('workstations')->insert(
            array(
                'FQDN' => 'wm3.prod.orlen.pl',
                'cpu' => 8,
                'ram' => 16,
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

        DB::table('workstations')->insert(
            array(
                'FQDN' => 'wm4.prod.orlen.pl',
                'cpu' => 2,
                'ram' => 2,
                'hdd' => 20,
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
