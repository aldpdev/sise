<head>
<?php include_once('header.php');

?>
</head>
<style>
  body, html {
    height: 100%; /* Hacer que el cuerpo y el HTML ocupen toda la altura */
    margin: 0;
    padding: 0;
}
.contenedor {
    display: flex;
    justify-content: left;
    align-items: center;
    height: 100vh;
    perspective: 1000px;
}

.imagen-con-onda {
    width: 80vh;
    height: 80vh;
    background-image: url('./imagenes/logo.png');
    background-size: cover;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    animation: rotate-animation 8s infinite linear; /* Animación de rotación */
    transform-style: preserve-3d;
}

@keyframes rotate-animation {
    0% {
        transform: rotate3d(0, 1, 0, 0deg);
    }
    100% {
        transform: rotate3d(0, 1, 0, 360deg);
    }

}

.typing-text {
    font-family: Arial, sans-serif;
    font-size: 50px;
    overflow: hidden;
    white-space: nowrap; 
    animation: typing 6s steps(40, end), blink-caret 0.75s;
}

@keyframes typing {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}
.typing-text {
    font-family: Arial, sans-serif;
    font-size: 50px;
}

.row1, .row2, .row3 {
    overflow: hidden;
    white-space: nowrap;
    border-right: 2px solid; /* Simula el cursor de escritura */
    margin: 0;
    padding: 0;
    width: 0;
    animation: typing 2s steps(40, end), blink-caret 0.75s step-end ;
}

.row1 {
    animation-delay: 0s; /* Iniciar animación inmediatamente */
}

.row2 {
    animation-delay: 2s; /* Retraso para iniciar la animación de la segunda fila */
}

.row3 {
    animation-delay: 4s; /* Retraso para iniciar la animación de la tercera fila */
}

@keyframes typing {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}

@keyframes blink-caret {
    from, to {
        border-color: transparent;
    }
    50% {
        border-color: black;
    }
}



/*./imagenes/logo.png
*/
  </style>
<body>
<?php include_once('menu.php'); ?>

<div class="right_col" role="main">
    <div class="page-title">
      <div class="contenedor">
        <div class="imagen-con-onda ">
        </div>
        <div class="typing-text">
        <h3 class="row1"> Bienvenidos</h3>
        <h3 class="row2"><small>Asamblea Legislativa Departamental</small></h3>
        <h3 class="row3"><small>Potosi - Bolivia</small></h3>
    </div>
      </div>
    </div>
</div>

  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js">
  </script>
  <script src="./lib/bootstrap.min.js">
  </script>

</body>
<footer>
<?php
include_once('footer.php');
?>
</footer>
</html>
