<head>
    <?php
    include_once('header.php');

    ?>
</head>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .contenedor {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        perspective: 1000px;
    }

    .imagen-con-onda {
        width: 60vh;
        height: 60vh;
        background-image: url('./imagenes/logo.png');
        background-size: cover;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
        animation: rotate-animation 8s infinite linear;
        transform-style: preserve-3d;
    }

    .typing-text {
        font-family: Arial, sans-serif;
        font-size:16px;
        text-align: center;
        margin-top: 20px;
    }

    @keyframes rotate-animation {
        0% {
            transform: rotate3d(0, 1, 0, 0deg);
        }

        100% {
            transform: rotate3d(0, 1, 0, 360deg);
        }
    }

    .row1,
    .row2,
    .row3 {
        overflow: hidden;
        white-space: nowrap;
        margin: 0;
        padding: 0;
        width: 0;
        animation: typing 2s steps(40, end), blink-caret 0.75s step-end;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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
        from,
        to {
            border-color: transparent;
        }

        50% {
            border-color: black;
        }
    }

    .row1,
    .row2,
    .row3 {
        animation-fill-mode: forwards;
    }

    @media only screen and (max-width: 768px) {
        .contenedor {
            flex-direction: column;
        }

        .imagen-con-onda {
            width: 80vw;
            height: 80vw;
        }

        .typing-text {
            font-size: 16px;
        }
    }
</style>
<body>
    <?php include_once('menu.php'); ?>

    <div class="contenedor">
        <div class="imagen-con-onda "></div>
        <div class="typing-text" style="width: 800px">
            <h1 class="row1" style="width: 800px">Bienvenidos</h3>
            <h3 class="row2"><small>Asamblea Legislativa Departamental</small></h3>
            <h3 class="row3"><small>Potosi - Bolivia</small></h3>
        </div>
    </div>


    <script src="./lib/jquery.min.js"></script>
    <script src="./lib/popper.min.js">
    </script>
    <script src="./lib/bootstrap.min.js">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function restartAnimation() {
                var elements = document.querySelectorAll('.row1, .row2, .row3');
                elements.forEach(function(element) {
                    element.style.animation = 'none';
                    void element.offsetWidth;
                    element.style.animation = null;
                });
            }

            setInterval(restartAnimation, 6000);
        });
    </script>

</body>
<footer>
    <?php
    include_once('footer.php');
    ?>
</footer>

</html>
