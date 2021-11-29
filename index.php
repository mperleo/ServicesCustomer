<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/mdb.dark.min.css">
        <link rel="stylesheet" href="css/mdb.min.css">
        <link rel="stylesheet" href="css/mdb.rtl.min.css">
        <title>SOA Practica services consumer</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav-tabs border-bottom border-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Services Customer</a>
                <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="electrica.php">Datos de demanda eléctrica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="junta.php">Analisis de datos de la junta</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card border border-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demanda electrica</h5>
                            <p class="card-text">
                            Datos de la demanda electrica en España
                            </p>
                            <a type="button" class="btn btn-outline-dark" href="electrica.php">ir</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border border-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Puntos de vehiculos electricos</h5>
                            <p class="card-text">
                            Datos de puntos de recarga de vehiculos electricos en Castilla y León en fechas dadas
                            </p>
                            <a type="button" class="btn btn-outline-dark" href="junta.php">ir</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border border-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Convocatoria de empleo público</h5>
                            <p class="card-text">
                            Datos de las convocatorias de empleo publico en castilla y leon entre fechas dadas
                            </p>
                            <a type="button" class="btn btn-outline-dark" href="junta.php">ir</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border border-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Establecimientos farmacéuticos</h5>
                            <p class="card-text">
                            Datos de establecimientos farmacéuticosen Castilla y León entre fechas dadas
                            </p>
                            <a type="button" class="btn btn-outline-dark" href="junta.php">ir</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border border-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Tasa de mortalidad COVID-19 por zonas de salud</h5>
                            <p class="card-text">
                            Datos de tasa de mortalidad COVID-19 por zonas de salud de Castilla y León entre fechas dadas
                            </p>
                            <a type="button" class="btn btn-outline-dark" href="junta.php">ir</a>
                        </div>
                    </div>
                </div>  

            </div>
        </div>
    </body>

<script src="js/mdb.min.js"></script>
</html>