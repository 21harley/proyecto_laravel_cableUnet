<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="icon" href="cableUnetIcon.ico" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>CableUNET</title>
</head>
<body>
    <header>
        <nav class="menu-boton">
            <div class="menu-boton-img">
              <img class="menu-boton-img-logo"src="cableUnet.svg" alt="SVGimgCableUnet">
            </div>
            <ul class="menu-boton-ul">
              <li class="menu-boton-li"><a target="_blank" class="menu-boton-a" href="https://dribbble.com/JH07">DRIBBLE</a></li>
              <li class="menu-boton-li"><a target="_blank" class="menu-boton-a" href="https://www.linkedin.com/in/john-llanes-6666aa161/">LIKEDIN</a></li>
              <li class="menu-boton-li"><a target="_blank" class="menu-boton-a" href="https://github.com/21harley?tab=repositories">GIT</a></li>
              <li class="menu-boton-li">
               @if(isset($_SESSION["level"]))
                <a class="menu-boton-a active" href="usuario">{{strtoupper($_SESSION["level"])}}</a>
               @else
                <a class="menu-boton-a" href="login">LOGIN</a>
               @endif
              </li>
            </ul>
        </nav>
    </header>
    <nav class="menu-options">

    </nav>
    <section class="menu-options-des">

    </section>
    <main>
     @yield('contenido')
    </main>
    <footer>
      <small>© Corporación CableUNET RIF. J-00000000-0. Todos los derechos reservados. 2021</small>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>