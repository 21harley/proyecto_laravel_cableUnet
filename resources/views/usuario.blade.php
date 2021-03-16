@extends('plantilla_1')

@section('contenido')
<div class="main-user">
    <div class="main-user-menu">
        <section class="main-user-settings-menu">
            <h2>{{strtoupper($_SESSION['data']["name"])}}</h2>
            <hr/>
           @if ($_SESSION['data']['level']==='admin')
             <ul class="main-user-settings-ul">
                <!--<li class="main-user-settings-li" >Opciones Servicio</li>-->
                <li class="main-user-settings-li settings-active" >Crear Servicio</li>
                <li class="main-user-settings-li" >Cargar Canal</li>
                <li class="main-user-settings-li" >Crear Plan de Tv</li>
                <li class="main-user-settings-li" >Crear paquete Servicio</li>
                <li class="main-user-settings-li" >Usuarios</li>
                <li class="main-user-settings-li" >Solicitud de Cambio</li>
                <li class="main-user-settings-li" >Factura</li>
             </ul> 
           @else
             <ul class="main-user-settings-ul1">
              <li class="main-user-settings-li1 settings-active" >Comprar Paquete</li>
              <li class="main-user-settings-li1" >Cambio de Paquete</li>
              <li class="main-user-settings-li1" >Registro facturas</li>
            </ul>           
           @endif 

        </section>
        <section class="main-user-settings-show">
          <div class="main-user-sentting-close">
              <div class="user-close"> 
                <a class="user-close-button" href="{{url('home')}}">Exit</a>
              </div>        
          </div>
          <div class="user-settings-show">
             @if($_SESSION['data']['level']==="admin")
                <section class="settings-show-CS settingA">
                  <form class="form-CS"action="{{url('registro')}}" method="POST">
                    {!! csrf_field() !!}
                    <h2 class="CS title-h2 input-A">Crear Servicio</h2>
                    <div class="tipo-servicio">
                      <label class="CS label-txt input-A" for="tservicio">Tipo Servicio:</label>
                      <select class="CS form-CS-input input-A" name="tservicio" id="tservicio">
                        <option class="option" value="internet">Internet</option>
                        <option class="option" value="cable">Cable</option>
                        <option class="option" value="telefono">Telefono</option>
                      </select> 
                    </div>
                    <div class="input-form-CS">
                      <label class="CS label-txt input-A" for="Sname">Nombre Servicio:</label><input class="CS form-CS-input input-A" type="text" name="name"  id="" placeholder="nombre" required>
                    </div>
                     <div class="input-form-CS">
                      <label class="CS label-txt input-A" for="Scosto">Costo Servicio:</label><input class="CS form-CS-input input-A" type="text" name="costo" id="" placeholder="costo" required>
                     </div>
                     <div class="input-form-CS">
                      <label class="CS label-txt input-A" for="Sdato">Dato Servicio:</label><input class="CS form-CS-input input-A" type="text" name="dato" id="datoE" placeholder="byte/s" required>
                     </div>
                      <input class="CS input-submit input-A" type="submit" value="Crear">
                   </form>
                </section>
                 <section class="settings-show-CP">
                  <form class="form-CS"action="{{url('registro')}}" method="POST">
                    {!! csrf_field() !!}
                    <h2 class="CP title-h2">Crear Paquete</h2>
                    <div class="input-form-CP">
                      <label class="CP label-txt " for="Sname">Nombre Paquete:</label><input class="CP form-CP-input " type="text" name="name"  id="" placeholder="nombre" required>
                    </div>
                    <div class="input-form-CP">
                      <label class="CP label-txt" for="telefonoT">Tipo Telefono:</label>
                      <select class="CP form-CP-input" title="telefonoT" id="telefonoT">
                        @if (empty ($_SESSION['telefono']))
                          <option value="">Sin registro</option>
                        @else
                          <option title="telefonoT" class="option" value=""></option>
                          @foreach ($_SESSION['telefono'] as $item)
                            <option title="telefonoT" class="option" value="{{$item['cost']}}-{{$item['id']}}">{{$item['name']}}</option>
                          @endforeach    
                        @endif
                      </select> 
                    </div>
                    <div class="input-form-CP">
                      <label class="CP label-txt" for="internetT">Tipo Internet:</label>
                      <select class="CP form-CP-input" title="internetT" id="internetT">
                        @if (empty ($_SESSION['internet']))
                          <option  value="">Sin registro</option>
                        @else
                          <option title="internetT" class="option" value=""></option>
                          @foreach ($_SESSION['internet'] as $item)
                            <option title="internetT"  class="option" value="{{$item['cost']}}-{{$item['id']}}">{{$item['name']}}</option>
                          @endforeach    
                        @endif
                      </select> 
                    </div>
                    <div class="input-form-CP">
                      <label class="CP label-txt" for="cableT">Tipo Cable:</label>
                        <select class="CP form-CP-input" title="cableT" id="cableT">
                        @if (empty ($_SESSION['cable']))
                          <option value="">Sin registro</option>
                        @else
                          <option title="cableT" class="option" value=""></option>
                          @foreach ($_SESSION['cable'] as $item)
                            <option title="cableT" class="option" value="{{$item['cost']}}-{{$item['id']}}">{{$item['name']}}</option>
                          @endforeach    
                        @endif
                        </select> 
                    </div>
                    <div class="input-form-CP">
                      <label class="CP label-txt" for="totalPagar">Total Pagar:</label>
                      <label class="CP label-txt" for="total" id="costoCP">0</label>
                    </div>
                      <input class="CP input-submit" type="submit" value="Crear">
                      <input type="hidden" name="telefono" id="Htelefono" value="">
                      <input type="hidden" name="cable" id="Hcable" value="">
                      <input type="hidden" name="internet" id="Hinternet" value="">
                      <input type="hidden" name="pago" id="Hpago" value="0">
                      <input type="hidden" name="tservicio" value="paquete">
                   </form>
                 </section>
                 <section class="settings-show-F">
                  <form class="form-CS" action="">
                    <h2 class="F title-h2 ">Registro facturas</h2>
                    <div class="container-facturas">
                      <div class="container-fac">
                        @if (empty ( $_SESSION['factura1']))
                          <label class="F" for="cbox2">Sin registros</label>
                        @else                     
                          <table class="default">
                          <tr>            
                            <th>Id</th>                      
                            <th>id_usu</th>
                            <th>id_paq</th>
                            <th>fecha</th>
                            <th>monto</th>
                          </tr>                  
                          @foreach ($_SESSION['factura1'] as $item)
                            <tr>                       
                              <td>{{$item['id']}}</td>                      
                              <td>{{$item['id_usuario']}}</td>                        
                              <td>{{$item['id_paquete']}}</td>
                              <td>{{$item['fecha']}}</td>
                              <td>{{$item['monto']}}</td>                          
                            </tr>
                          @endforeach 
                          </table>    
                        @endif
                      </div>
                    </div>
                  </form>
                 </section>
                 <section class="settings-show-S">
                  <div class="form-CS">
                    <h2 class="S title-h2 ">Solicitud Cambio</h2>
                    <div class="container-facturas">
                      <div class="container-fac">
                        @if (empty ( $_SESSION['solicitud']))
                        <label class="S" for="cbox2">Sin registros</label>
                        @else                     
                         <table class="default">
                          <tr>            
                            <th>Id</th>                      
                            <th>p_a</th>
                            <th>p_c</th>
                            <th>idUsu</th>
                            <th>A</th>
                            <th>R</th>
                          </tr>                  
                          @foreach ($_SESSION['solicitud'] as $item)
                              <tr>                       
                                <td>{{$item['id']}}</td>                      
                                <td>{{$item['id_pq_act']}}</td>                        
                                <td>{{$item['id_pq_cam']}}</td>
                                <td>{{$item['id_usuario']}}</td>
                                <td>
                                  <form  action="{{url('registro')}}" method="POST">
                                   {!! csrf_field() !!}
                                   <input type="hidden" name="tservicio" value="tcamA">
                                   <input type="hidden" name="tusu" value="{{$item['id_usuario']}}">
                                   <input type="hidden" name="tcam" value="{{$item['id_pq_cam']}}">
                                   <input type="hidden" name="r" value="{{$item['id']}}">
                                   <input type="submit" value="Aceptar">
                                  </form>
                                </td> 
                                <td>
                                  <form  action="{{url('registro')}}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="tservicio" value="tcamR">
                                    <input type="hidden" name="r" value="{{$item['id']}}">
                                    <input type="submit" value="Rechazar">
                                   </form>
                                </td>                         
                              </tr>
                          @endforeach 
                          </table>    
                        @endif
                      </div>
                    </div>
                  </div>
                 </section>
                 <section class="settings-show-U">
                  <form class="form-CS" action="">
                    <h2 class="U title-h2 ">Registro Usuario</h2>
                    <div class="container-facturas">
                      <div class="container-fac">
                        @if (empty ( $_SESSION['usuario']))
                        <label class="U" for="cbox2">Sin registros</label>
                        @else   
                        <table class="default">
                          <tr>            
                            <th>Id</th>                      
                            <th>Nombre</th>
                            <th>Paquete</th>
                            <th>Nivel</th>
                            <th>Saldo</th>
                          </tr>                  
                          @foreach ($_SESSION['usuario'] as $item)
                            <tr>                       
                              <td>{{$item['id']}}</td>                      
                              <td>{{$item['name']}}</td>                        
                              <td>{{$item['paquete']}}</td>
                              <td>{{$item['level']}}</td>
                              <td>{{$item['saldo']}}</td>                          
                            </tr>
                          @endforeach 
                          </table>   
                        @endif
                      </div>
                    </div>
                  </form>
                 </section>
                 <section class="settings-show-CC ">
                  <form class="form-CS"action="{{url('registro')}}" method="POST">
                    {!! csrf_field() !!}
                    <h2 class="CC title-h2 ">Registrar Canal Tv</h2>
                    <div class="input-form-CS">
                      <label class="CC label-txt " for="Sdato">Canal Tv:</label><input class="CC form-CS-input " type="text" name="datoT"  placeholder="canal tv" required>
                     </div>
                     <div class="input-form-CS">
                      <label class="CC label-txt " for="Sdato">Costo:</label><input class="CC form-CS-input " type="text" name="datoC"  placeholder="costo" required>
                     </div>
                     <input class="CC input-submit " type="submit" value="Crear">                    
                    <input type="hidden" name="tservicio" value="canal">
                  </form>
                 </section>
                 <section class="settings-show-CPT ">
                  <form class="form-CS"action="{{url('registro')}}" method="POST">
                    {!! csrf_field() !!}
                    <h2 class="CPT title-h2 ">Crear Plan de Tv</h2>
                    <div class="input-form-CS">
                        <label class="CPT label-txt" for="plaT">Nombre Plan:</label>
                        <select class="CPT form-CP-input" name="planT" title="planT" id="plaT">
                          @if (empty ($_SESSION['cable']))
                            <option value="vacio">Sin registro</option>
                          @else
                            <option title="plaT" class="option" value=""></option>
                            @foreach ($_SESSION['cable'] as $item)
                              <option title="planT" class="option" value="{{$item['id']}}">{{$item['plan']}}</option>
                            @endforeach    
                          @endif
                        </select> 
                    </div>
                    <div class="container-chackbok">
                      <div class="container-chack">
                        @if (empty ( $_SESSION['canal']))
                        <label class="CPT" for="cbox2">Sin registros</label>
                        @else                     
                          @foreach ($_SESSION['canal'] as $item)
                          <input class="CPT cbox" type="checkbox" title="canal" name="nombre" value="{{$item['cost']}}-{{$item['id']}}"><label for="cbox2">{{$item['name']}}</label><br/>
                          @endforeach    
                        @endif
                      </div>
                    </div>
                    <div class="input-form-CP">
                      <label class="CP label-txt" for="totalPagar">Total Pagar:</label>
                      <label class="CP label-txt" for="total" id="costoCPT">0</label>
                    </div> 
                    <input class="CPT input-submit" type="submit" value="Crear">                    
                    <input type="hidden" name="tservicio" value="plan">
                    <input type="hidden" name="tcanales" id="canales" value="">
                    <input type="hidden" name="pago" id="CPTpago" value="0">
                  </form>
                 </section>
             @else
              <section class="settings-show-SCP settingA">
                <form class="SCP form-CS input-A" action="{{url('registro')}}" method="POST">
                  {!! csrf_field() !!}
                  <h2 class="SCP title-h2 ">Comprar Paquete</h2>
                  <div class="input-form-CS">
                    <label class="SCP label-txt input-A" for="plaT">Paquete:</label>
                    <select class="SCP form-CP-input input-A" name="paqueteT" title="paqueteT" id="paqueteT">
                      @if (empty ($_SESSION['paquete']))
                        <option value="">Sin registro</option>
                      @else
                        <option title="paqueteT" class="option1" value=""></option>
                        @foreach ($_SESSION['paquete'] as $item)
                          <option title="paqueteT" class="option1" value="{{$item['id']}}" costo="{{$item['cost']}}">{{$item['name']}}</option>
                        @endforeach    
                      @endif
                    </select> 
                  </div>
                  <div class="input-form-CP">
                    <label class="SCP label-txt input-A" for="costoPaquete">Costo Paquete:</label>
                    <label class="SCP label-txt input-A" for="total" id="costoSCP">0</label>
                  </div> 
                  <div class="input-form-CP">
                    <label class="SCP label-txt input-A" for="saldo">Saldo:</label>
                    <label class="SCP label-txt input-A" for="saldo" id="saldoSCP">{{$_SESSION['user']['saldo']}}</label>
                  </div> 
                  <input class="SCP input-submit input-A" type="submit" value="Crear">                    
                  <input type="hidden" name="tservicio" value="userPaquete">
                  <input type="hidden" name="tuser" id="userp" value="{{$_SESSION['user']['id']}}">
                  <input type="hidden" name="tcostp" id="costp" value="">
                  <input type="hidden" name="pago" id="CPTpago" value="0">                    
                </form>
              </section>  
              <section class="settings-show-SCAP">
                  <form class="SCAP form-CS " action="{{url('registro')}}" method="POST">
                    <h2 class="SCAP title-h2 ">Cambiar Paquete</h2>
                    {!! csrf_field() !!}
                    <div class="input-form-CS">
                      <label class="SCAP label-txt " for="plaT">Paquete Actual:</label>
                        <label class="SCAP label-txt " for="saldo" id="actualP">
                          @if(isset($_SESSION['userP']['name']))
                          {{$_SESSION['userP']['name']}}
                          @else
                          Sin registro
                          @endif
                        </label>
                      <label class="SCAP label-txt " for="plaT">Nuevo Paquete:</label>
                      <select class="SCAP form-CP-input " name="paqueteN" title="paqueteN" id="paqueteN">
                        @if (empty ($_SESSION['paquete']))
                          <option value="">Sin registro</option>
                        @else
                          <option title="paqueteN" class="option2" value=""></option>
                          @foreach ($_SESSION['paquete'] as $item)
                            <option title="paqueteN" class="option2" value="{{$item['id']}}" costo="{{$item['cost']}}">{{$item['name']}}</option>
                          @endforeach    
                        @endif
                      </select> 
                  </div>
                  <input class="SCAP input-submit" type="submit" value="Cambiar"> 
                  <input type="hidden" name="tservicio" value="cambioP">
                  <input type="hidden" name="tuser"  value="{{$_SESSION['user']['id']}}">
                  @if(isset($_SESSION['userP']['id']))
                    <input type="hidden" name="tp"  value="{{$_SESSION['userP']['id']}}">
                  @else
                    <input type="hidden" name="tp"  value="">
                  @endif
                  <input type="hidden" name="pago" id="CPTpago" value="0">                    
                  </form>
              </section>
              <section class="settings-show-RF">
                <form class="form-CS" action="">
                  <h2 class="SCAP title-h2 ">Registro facturas</h2>
                  <div class="container-facturas">
                    <div class="container-fac">
                      @if (empty ( $_SESSION['factura1']))
                      <label class="CPT" for="cbox2">Sin registros</label>
                      @else                     
                      <table class="default">
                        <tr>            
                          <th>Id</th>                      
                          <th>Name</th>
                          <th>id_paquete</th>
                          <th>fecha</th>
                          <th>monto</th>
                        </tr>                  
                        @foreach ($_SESSION['factura1'] as $item)
                          <tr>                       
                            <td>{{$item['id']}}</td>                      
                            <td>{{$_SESSION['data']["name"]}}</td>                        
                            <td>{{$item['id_paquete']}}</td>
                            <td>{{$item['fecha']}}</td>
                            <td>{{$item['monto']}}</td>                          
                          </tr>
                        @endforeach 
                        </table>     
                      @endif
                    </div>
                  </div>
                </form>
              </section>                
             @endif
          </div>
        </section>
    </div>
</div>
@endsection