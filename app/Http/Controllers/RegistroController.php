<?php

namespace App\Models\User;
namespace App\Models\Telephony;
namespace App\Models\Internet;
namespace App\Models\Cable;
namespace App\Models\Paquete;
namespace App\Models\Channel;
namespace App\Models\Factura;
namespace App\Http\Solicitud;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Telephony;
use App\Models\Internet;
use App\Models\Cable;
use App\Models\Paquete;
use App\Models\Channel;
use App\Models\Factura;
use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Collection;

class RegistroController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function create(){
        return view('newUser');
    }
    public function store(){
        $data=request()->all();

        switch($data['tservicio']){
            case "internet":
                Internet::create([
                   'name'=>$data['name'],
                   'cost'=>$data['costo'],
                   'byte/s'=>$data['dato'],
                ]);
                $_SESSION['internet']=Internet::all()->toArray();
            break;
            case "cable":
                Cable::create([
                   'name'=>$data['name'],
                   'cost'=>$data['costo'],
                   'plan'=>$data['dato'],
                ]);
                $_SESSION['cable']=Cable::all()->toArray();
            break;
            case "telefono":
                Telephony::create([
                   'name'=>$data['name'],
                   'cost'=>$data['costo'],
                   'time'=>$data['dato'],
                ]);
                $_SESSION['telefono']=Telephony::all()->toArray();
            break;
            case "paquete": 
                //dd($data);
                Paquete::create([
                    'name'=>$data['name'],
                    'cable_id'=>$data['cable'],
                    'internet_id'=>$data['internet'],
                    'telephony_id'=>$data['telefono'],
                    'cost'=>$data['pago']
                ]);
                
            break; 
            case "canal":
                Channel::create([
                    'name'=>$data['datoT'],
                    'assPlan'=>'',
                    'cost'=>$data['datoC'],
                ]);
                $_SESSION['canal']=Channel::all()->toArray();
            break;
            case "plan":
                //dd($data);
                $cadena=explode("-",$data['tcanales']);
                //dd($cadena);
                $cable=Cable::where('id',intval($data['planT']))->select("plan","cost")->get()->toArray();
                $pago=0;//valor del plan
                foreach ($cadena as &$valor) {
                    if($valor!=""){
                        $assplan=Channel::where('id',intval($valor))->select("assPlan","cost")->get()->toArray();
                        //dd($assplan[0]["assPlan"]);

                        if(empty($assplan[0]["assPlan"])!=true){
                            if ( strpos($assplan[0]["assPlan"],$cable[0]["plan"]) === false) {
                                $assplan[0]["assPlan"]=$assplan[0]["assPlan"]."-".$cable[0]["plan"];
                                $pago+=intval($assplan[0]["cost"]);
                            }
                        }else{
                            $assplan[0]["assPlan"]=$assplan[0]["assPlan"].$cable[0]["plan"];
                            $pago+=intval($assplan[0]["cost"]);
                        }

                        Channel::where('id', intval($valor))->update(['assPlan' => $assplan[0]["assPlan"]]);

                    }
                }
                $pago=$pago+$cable[0]["cost"];
                Cable::where('id', intval($data['planT']))->update(['cost' => $pago]);
            break;
            case 'userPaquete':
                //dd($data);
                $usuario=User::where('id',intval($data['tuser']))->select("saldo","paquete")->get()->toArray();
                $aux=$usuario[0];
                if(intval($aux["saldo"])>intval($data['tcostp'])){
                    
                    if($aux["paquete"]==""){
                        $aux["saldo"]=intval($aux["saldo"])-intval($data['tcostp']);
                        $aux["paquete"]=$data["paqueteT"];
                        User::where('id', intval($data['tuser']))->update(['saldo' => $aux["saldo"],"paquete"=>$aux["paquete"]]);
                        $hoy = getdate();
                        $fecha=$hoy['year']."/".$hoy["month"]."/".$hoy["mday"];
                        Factura::create([
                            'id_usuario'=>$data['tuser'],
                            'id_paquete'=>$aux["paquete"],
                            'fecha'=>$fecha,
                            'monto'=>$data['tcostp'],
                         ]);
                    }
                }
                $_SESSION['usuario']=User::where('id',intval($data['tuser']))->get()->toArray();
                $_SESSION['factura1']=Factura::where("id_usuario",intval($data['tuser']))->get()->toArray();
                $_SESSION['user']=$_SESSION['usuario'][0];
                $_SESSION['userP']=Paquete::where("id",intval($aux['paquete']))->get()->toArray();
                if(!empty($_SESSION['userP'])){
                    $_SESSION['userP']=$_SESSION['userP'][0];
                }    
            break;
            case 'cambioP':
                
                if(isset($data['tp'])){
                    if($data['tp']!=$data['paqueteN']){
                        Solicitud::create([
                            'id_pq_act'=>$data['tp'],
                            'id_pq_cam'=>$data['paqueteN'],
                            'id_usuario'=>$data['tuser'],
                        ]); 
                    }
                }

            break;
            case 'tcamA':
                User::where('id', intval($data['tusu']))->update(['paquete' => $data['tcam']]);
                Solicitud::where('id', intval($data['r']))->delete();
                $_SESSION['solicitud']=Solicitud::all()->toArray();
            break;
            case 'tcamR':
                Solicitud::where('id', intval($data['r']))->delete();
                $_SESSION['solicitud']=Solicitud::all()->toArray();
            break;  
        }
        return view('usuario');
    }

    public function show(){
       return view('login');
    }
}
