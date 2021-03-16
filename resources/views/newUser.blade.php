@extends('plantilla_1')

@section('contenido')
<div class="login-newUser">
    <img class="login-img-fondo"src="assets/fondoLogin.png" alt="SVGimgCableUnet">
    <img class="login-logo"src="cableUnet.svg" alt="SVGimgCableUnet">
    <section class="login-form-new">
        <form class="login-form-new-body" action="{{url('newUser/create')}}" method="POST">
            {!! csrf_field() !!}
            <h2 class="login-form-title">Register new user</h2>
            <input required class="login-form-new-input"  name="name" type="text" placeholder="Username" >
            <input required class="login-form-new-input"  name="password" type="password" placeholder="password" >
            <input required class="login-form-new-input"  name="D/P" type="text" placeholder="Document/passport">
            <input required class="login-form-new-input"  name="phone" type="text" placeholder="Phone" >
            <input required class="login-form-new-input"  name="email" type="email" placeholder="email" >
            <input  class="login-form-new-submit"  type="submit" value="Register">
            <a class="login-form-return" href="{{url('login')}}">return login</a>
        </form>
    </section>
</div>   
@endsection