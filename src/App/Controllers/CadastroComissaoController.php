<?php

namespace Project\Controllers;

use Project\Models\CommissionsModel;
use Project\Models\IndicationsModel;
use \Psr\Container\ContainerInterface;
use Respect\Validation\Validator as V;

class CadastroComissaoController
{
   protected $container;


   public function __construct(ContainerInterface $container) 
   {
       $this->container = $container;
   }

   public function cadastroComissao($data)
   {
        $value_commission   = $data['value_commission'];
        $start_date         = $data['start_date'];
        $end_date           = $data['end_date'];
        $indication_uuid    = $data['uuid'];
        $commission         = $data['commission'];
        $meses              = 0;

        if($commission == 1){

        }
        else{
            $ano_ini = substr($start_date,0,4);
            if(count($start_date) == 9){
                $mes_ini = substr($start_date,5,-3);
            }
            else{
                $mes_ini = substr($start_date,5,-3);
            }
            $ano_fim = substr($end_date,0,4);
            if(count($end_date) == 9){
                $mes_fim = substr($end_date,5,-3);
            }
            else{
                $mes_fim = substr($end_date,5,-3);
            }

            if($ano_ini == $ano_fim){
                $meses = $mes_fim - $mes_ini;
                $anos = 0;
            }
            else{
                $anos = $ano_fim - $ano_ini;
                $meses = $anos * 12;
                $meses += $mes_fim - $mes_ini;
            }
            $mes = $mes_ini;
            $ano = $ano_ini;

            $d = mktime (0, 0, 0, date("m")-1, date("d"),  date("Y"));
            
            $commissionsModel = new CommissionsModel($this->container);
            for($i=0; $i<=$meses;$i++){
                $mes = $mes_ini;
                $ano = $ano_ini;
                $uuid = uuid();
                $mes += $i;
                $teste = 0 ;
                if((int)($mes/13) > 0){
                    $ano += (int)($mes/13);

                    if((int)($mes % 12) == 1 && $mes != 13) $ano++;

                    if((int)($mes % 12) == 0)   $mes = 12;
                    else    $mes = (int)($mes % 12);
                }

                $commissionsModel->set(["uuid"=>$uuid,  
                                        "value_commission"=>$value_commission,
                                        "date"=>$ano."-".$mes."-01",
                                        "indication_uuid"=>$indication_uuid]);
            }
        }
   }
}