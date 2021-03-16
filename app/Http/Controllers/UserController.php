<?php
namespace App\Models\Telephony;
namespace App\Models\Internet;
namespace App\Models\Cable;
namespace App\Models\User;
namespace App\Models\Channel;
namespace App\Models\Factura;
namespace App\Http\Solicitud;
namespace App\Http\Paquete;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telephony;
use App\Models\Internet;
use App\Models\Cable;
use App\Models\User;
use App\Models\Channel;
use App\Models\Factura;
use App\Models\Solicitud;
use App\Models\Paquete;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function create(){
        return view('newUser');
    }
    public function beginning(){
        $data=request()->all();
        $respuesta=User::where('C_P',$data['D/P'])->first();
        //dd($respuesta);
        if(is_object($respuesta)){
            $_SESSION['data']=$respuesta;
            $_SESSION["level"]=$respuesta['level'];
            if($_SESSION['level']=='admin'){
                $_SESSION['cable']=Cable::all()->toArray();
                $_SESSION['internet']=Internet::all()->toArray();
                $_SESSION['telefono']=Telephony::all()->toArray();
                $_SESSION['canal']=Channel::all()->toArray();
                $_SESSION['usuario']=User::all()->toArray();
                $_SESSION['factura1']=Factura::all()->toArray();
                $_SESSION['solicitud']=Solicitud::all()->toArray();
            }else{
                $_SESSION['usuario']=User::where('C_P',$data['D/P'])->get()->toArray();
                $aux=$_SESSION['usuario'][0];
                $_SESSION['user']=$_SESSION['usuario'][0];
                $_SESSION['factura1']=Factura::where("id_usuario",intval($aux['id']))->get()->toArray();
                $_SESSION['userP']=Paquete::where("id",intval($aux['paquete']))->get()->toArray();
                if(!empty($_SESSION['userP'])){
                    $_SESSION['userP']=$_SESSION['userP'][0];
                }             
                $_SESSION['paquete']=Paquete::all()->toArray();
            }
            //return  view('usuario',['user'=>$respuesta]);
            return  view('usuario');
        }else{
            return  view('login');
        }

    }
    public function load(){
        return  view('usuario');
    }
    public function store(){
        $data=request()->all();
        //dd($data);
        User::create([
           'name'=>$data['name'],
           'password'=>$data['password'],
           'C_P'=>$data['D/P'],
           'saldo'=>'25000',
           'estado'=>'A',
           'paquete'=>'',
           'phone'=>$data['phone'],
           'email'=>$data['email'],
           'level'=>'user'
        ]);
        return redirect('login');
    }
    public function show(){
       return view('login');
    }
    public function close(){
        unset($_SESSION['data']);
        unset($_SESSION['level']);
        return view('welcome');
     }
}
