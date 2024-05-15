<?php require ('header.php');

?>
<div class="container-fluid ">

    <h2 class="text-center">GESTION DE USUARIO</h2>

    <div class="row justify-content"> <!-- Utilizamos las clases de Bootstrap para centrar el contenido -->
        <div class="col-md-6"> <!-- Utilizamos las clases de Bootstrap para controlar el ancho del contenido -->

            <div class="card-group">
                <div class="card bg-transparent border-0" style="height: fit-content;">
                    <div class="card text-white bg-info mb-3" style="max-width: 13rem;">
                        <div class="card-body d-flex align-items-center justify-content-start p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor"
                                class="bi bi-person-fill me-2" viewBox="0 0 16 13">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <div>
                                <h1 class="card-text mb-0">60</h1>
                                <h5 class="mb-0">actuales</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-transparent border-0" style="height: fit-content;">
                    <div class="card text-white bg-success  mb-3" style="max-width: 13rem;">
                        <div class="card-body d-flex align-items-center justify-content-start p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor"
                                class="bi bi-person-check-fill" viewBox="0 0 16 13">
                                <path fill-rule="evenodd"
                                    d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            <div>
                                <h1 class="card-text mb-0">10</h1>
                                <h5 class="mb-0">conectados</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-transparent border-0" style="height: fit-content;">
                    <div class="card text-white bg-danger  mb-3" style="max-width: 13rem;">
                        <div class="card-body d-flex align-items-center justify-content-start p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="currentColor"
                                class="bi bi-person-x-fill" viewBox="0 0 16 13">
                                <path fill-rule="evenodd"
                                    d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708" />
                            </svg>
                            <div>
                                <h1 class="card-text mb-0">50 </h1>
                                <h5 class="mb-0">desconectados</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row justify-content">
        <div class="col-md-8 offset-md-2 input-group">
            <div id="tablaareas_filter" class="dataTables_filter">
                <label>
                    <input type="search" class="form-control form-control-sm" placeholder="Buscar:"
                        aria-controls="tablaareas">
                </label>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <caption>List of users</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">usuario</th>
                            <th scope="col">nivel</th>
                            <th scope="col">opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td> <button type="button" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-warning"><i class="fas fa-times-circle"></i></button>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td> <button type="button" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-warning"><i class="fas fa-times-circle"></i></button>

                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td> <button type="button" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                <button type="button" class="btn btn-warning"><i class="fas fa-times-circle"></i></button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



</div>






<?php
include_once ('footer.php');
?>