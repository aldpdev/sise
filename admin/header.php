<!--HEADER PARA ADMINISTRADOR-->
<?php
ob_start();
header("Expires: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8");
session_start();
ob_end_flush();
require_once ('../globals.php');
require_once ('../db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Admin ALDP</title>
  <link rel="shortcut icon" href="../images/favicon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../assets/sweetalert2/sweetalert2.min.css">
  <?php
  //funcion retorna true o false si no existe usertable en session false si es id diferente false
  //si ho hay usertable en session  FALSE
  //de usuario es true su multi llogion  TRUE
  //si el ip son diferentes FALSE
  if (!isset($_POST['noflush']))
    ob_end_flush();
  if (!ValidSession()) {
    InvalidSession("admin/index.php");////funcion para expirar el session y registar 3= debug en logtable
    ForceLoad("../index.php");//index.php
  }

  if ($_SESSION["usertable"]["usertype"] != "admin") {//system
    IntrusionNotify("admin/index.php");
    ForceLoad("../index.php");//index.php
  }
  ?>
</head>
<!--fin de head-->

<body class="sb-nav-fixed">

  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <!--class="navbar navbar-expand-lg bg-body-tertiary"-->
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php">ALDP</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="reception.php" id="nuevo_do">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                <path
                  d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
              </svg> Nuevo documento
            </a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill"
                viewBox="0 0 16 16">
                <path
                  d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
              </svg> Entrada documento
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="listdocuments.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
              </svg>
              Lista documentos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="seguimiento.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                <path
                  d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                <path fill-rule="evenodd"
                  d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
              </svg> Seguimiento
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                <path d="M6 12v-2h3v2z" />
                <path
                  d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
              </svg> Reportes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-people-fill" viewBox="0 0 16 16">
                <path
                  d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
              </svg> Gestion usuarios
            </a>
          </li>

        </ul>

        <!--<form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#updateModal">Mi cuenta</a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="../index.php">Salir del sistema</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--PARA UPDATE-->
  <?php
  include '../optionlower.php';
  ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener todos los enlaces de navegación
        var navLinks = document.querySelectorAll('.nav-link');

        // Iterar sobre los enlaces y agregar la clase 'active' al enlace con el href correspondiente a la URL actual
        navLinks.forEach(function(navLink) {
            // Obtener el valor del atributo href de cada enlace
            var href = navLink.getAttribute('href');

            // Comparar el valor del atributo href con la URL actual
            if (window.location.href.indexOf(href) !== -1) {
                navLink.classList.add('active');
            }
        });
    });
</script>
