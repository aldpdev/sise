<?php
session_start();

if (!isset($_SESSION['nombre']) && !isset($_SESSION['rol'])) {
  header('Location: ./');
  exit;
}
if ($_SESSION['rol'] != "ADMINISTRADOR") {
  header('Location: ./');
  exit;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ALDP</title>
  <link rel="stylesheet" href="./lib/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="./tm/toastr.scss" rel="stylesheet" />

  <style>
    body {
      background: #EAEAEA;
      color: #514d51;
      font-size: small;
    }

    .container {
      max-width: 60%;
      margin-top: 0px;
    }

    .form-control {
      background-color: #ffffff;
      border: none;
      border-radius: 0;
      color: #110b12;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 0;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #0069d9;
      border: none;
      border-radius: 0;
    }

    label {
      color: #110b12;
      font-weight: bold;
      text-transform: uppercase;
    }
  </style>
</head>
