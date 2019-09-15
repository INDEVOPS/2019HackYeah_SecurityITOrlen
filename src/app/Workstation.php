<?php

namespace App;

use App\Template;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function paramSections(){
        return array(
            'Konfiguracja' => [
                'cpu' => [
                    'label' => 'Procesory [vCPU]',
                    'type'  => 'number',
                    'warning' => 'Zmiejsz vCPU',
                    'error' => 'Zwiększ ilość vCPU',
                ],
                'ram' => [
                    'label' => 'Pamięć [GB]',
                    'type'  => 'number',
                    'warning' => 'Zmiejsz ilość RAMu',
                    'error' => 'Zwiększ ilość RAMu',
                ],
                'hdd' => [
                    'label' => 'Dysk [GB]',
                    'type'  => 'number',
                    'warning' => 'Zmiejsz dostępną ilość miejsca na dysku',
                    'error' => 'Zwiększ dostępną ilość miejsca na dysku'
                ],
            ],
            'Urządzenia' => [
                'devices_usb' => [
                    'label' => 'USB dozwolone',
                    'type'  => 'boolean',
                    'error' => 'Zmień ustawienia portów USB',
                ],
                'devices_cd' => [
                    'label' => 'Stacja dysków dozwolona',
                    'type'  => 'boolean',
                    'error' => 'Zmień ustawienia stacji CD',
                ],
                'devices_mouse' => [
                    'label' => 'Myszka podłączona',
                    'type'  => 'boolean',
                    'error' => 'Zmień stan podłączenia myszy',
                ],
                'devices_keyboard' => [
                    'label' => 'Klawiatura podłączona',
                    'type'  => 'boolean',
                    'error' => 'Zmień stan podłączenia klawiatury',
                ],
            ],
            'System operacyjny' => [
                'os' => [
                    'label' => 'System operacyjny',
                    'type'  => 'text',
                    'error' => 'Zmień system operacyjny',
                ],
                'os_version' => [
                    'label' => 'Nazwa ostatniej poprawki',
                    'type'  => 'text',
                    'error' => 'Zaktualizuj system do odpowiedniej wersji',
                ],
            ],
            'Zapora sieciowa' => [
                'firewall_enabled' => [
                    'label' => 'Zapora sieciowa włączona',
                    'type'  => 'boolean',
                    'error' => 'Napraw konfigurację zapory sieciowej',
                ],
            ],
            'Interfejsy sieciowe' => [
                'lan_enabled' => [
                    'label' => 'Interfejs LAN',
                    'type'  => 'boolean',
                    'error' => 'Zmień stan interfejsu LAN',
                ],
                'lan_mask' => [
                    'label' => 'Maska podsieci',
                    'type'  => 'text',
                    'error' => 'Zmień maskę podsieci',
                ],
                'lan_gateway' => [
                    'label' => 'Brama podsieci',
                    'type'  => 'text',
                    'error' => 'Zmień adres bramy podsieci',
                ],
                'lan_dns' => [
                    'label' => 'DNS',
                    'type'  => 'text',
                    'error' => 'Zmień adres DNS',
                ],
            ],
        );
    }

    public static function params(){
        $params = [];

        foreach(self::paramSections() as $section_parametes){
            $params = array_merge($params, $section_parametes);
        }

        return $params;
    }

    public function getTemplateAttribute(){
        
        $templates = Template::all();

        foreach($templates as $template) {
            if(preg_match($template->regex, $this->FQDN))
                return $template;
        }

        return null;
    }

    public function getErrorsAttribute(){
        return $this->Issues['errors'];
    }

    public function getWarningsAttribute(){
        return $this->Issues['warnings'];
    }

    public function getIssuesAttribute(){
        if($this->template == null){
            return [
                'warnings' => '-',
                'errors' => '-'
            ];
        }

        $ret = [
            'warnings' => 0,
            'errors' => 0
        ];

        foreach(self::params() as $param => $options){
            $status = $this->getParamStatus($param);

            if($status == 1)
                $ret['warnings']++;
            
            if($status == 2)
                $ret['errors']++;
        }

        return $ret;
    }

    // 0 - No problems
    // 1 - Warning
    // 2 - Error
    public function getParamStatus($param){
        if($this->template == null)
            return 0;

        $current_value = $this->getAttribute($param);
        $template_value = $this->template->getAttribute($param);

        if(self::params()[$param]['type'] == 'number'){

            if($current_value < $template_value)
                return 2;
            
            if($current_value > $template_value)
                return 1;

        }

        if(
            self::params()[$param]['type'] == 'boolean'
            || self::params()[$param]['type'] == 'text'
            || self::params()[$param]['type'] == 'textarea'
        ){
            
            if($current_value != $template_value)
                return 2;

        }
        

        // ...
        return 0;
    }

    public function getParamTips($param){
        if($this->template == null)
            return null;
        
        $options = self::params()[$param];

        $status = $this->getParamStatus($param);

        if($status == 0) return null;

        if($status == 1 && array_key_exists( 'warning', $options ))
            return $options['warning'];
        
        if($status == 2 && array_key_exists( 'error', $options ))
            return $options['error'];
    }
}