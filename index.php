<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode-aMatosCar</title>
    <link rel="icon" type="image" href="https://amatoscar.pt/assets/media/general/logoamatoscar.webp">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a href="/">
                <img src="https://amatoscar.pt/assets/media/general/logoamatoscar.webp" height="50px" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mx-3" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown btn-m-h-orange rounded-btn">
                        <a id="concession-text" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Concessão
                        </a>
                        <ul class="dropdown-menu" id="concession-list">

                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown btn-m-h-orange rounded-btn">
                            <a id="dropdown-search-by-text" class="nav-link dropdown-toggle me-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            </a>
                            <ul class="dropdown-menu" id="search-by">

                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="" aria-label="Search">
                        <button class="btn btn-m-o-orange" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <!-- Users Table -->
    <table class="table text-center align-middle">
        <thead class="text-dark">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Concessão</th>
                <th scope="col">Função</th>
                <th scope="col">QRCode</th>
            </tr>
        </thead>

        <tbody id="users-tbody">

        </tbody>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/index.js"></script>

</html>