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
                ],
                'ram' => [
                    'label' => 'Pamięć [GB]',
                    'type'  => 'number',
                ],
                'hdd' => [
                    'label' => 'Dysk [GB]',
                    'type'  => 'number',
                ],
            ],
            'Urządzenia' => [
                'devices_usb' => [
                    'label' => 'USB dozwolone',
                    'type'  => 'boolean',
                ],
                'devices_cd' => [
                    'label' => '...',
                    'type'  => 'boolean',
                ],
                'devices_mouse' => [
                    'label' => '...',
                    'type'  => 'boolean',
                ],
                'devices_keyboard' => [
                    'label' => '...',
                    'type'  => 'boolean',
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

        $parameters = ['cpu', 'ram', 'hdd'];

        foreach($parameters as $param){
            $current_value = $this->getAttribute($param);
            $template_value = $this->template->getAttribute($param);

            if($current_value < $template_value)
                $ret['errors']++;
            else if ($current_value > $template_value)
                $ret['warnings']++;
        }

        return $ret;
    }

}
