@extends('plantilla_1')

@section('contenido')
<div class="login-main">
    <img class="login-img-fondo"src="assets/fondoLogin.png" alt="SVGimgCableUnet">
    <img class="login-logo"src="cableUnet.svg" alt="SVGimgCableUnet">
    <section class="login-form">
        <h2 class="login-form-title">Login</h2>
        <form class="login-form-body" action="{{url('usuario')}}" method="POST">
            {!! csrf_field() !!}
            <input name="username" class="login-form-input"type="text" placeholder="Username" required>
            <input name="password" class="login-form-input"type="password" placeholder="password" required>
            <input name="D/P" class="login-form-input"type="text" placeholder="Document/passport" required>
            <input class="login-form-submit"type="submit" value="login">
        </form>
        <hr class="login-barra"/>
        <input class="login-form-username" type="button" value="create new account">
    </section>
</div>   
@endsection
