<!-- Navbar -->
<nav class="navbar navbar-expand-md h-10">
    <div class="container-fluid d-flex align-items-center">
        <button class="navbar-toggler my-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Phone navbar buttons -->
        <div class="d-flex d-md-none flex-fill justify-content-around">
            <a class="nav-link mx-2" href="#"><i class="bi bi-person-circle"></i></a>
            <a class="nav-link mx-2" href="#"><i class="bi bi-bell"></i></a>
            <a class="nav-link mx-2" href="#"><i class="bi bi-cart"></i></a>
        </div>
        <a class='navbar-brand d-flex justify-content-center' href='../index.php'>
            <img src='assets/Imagotipo.png' alt='' height='30 rem'>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav container-fluid">
                <!-- Categorys -->
                <li class="nav-item dropdown ms-md-auto d-flex align-items-center justify-content-center">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Tecnologia</a></li>
                        <li><a class="dropdown-item" href="#">Ingles</a></li>
                        <li><a class="dropdown-item" href="#">Web development</a></li>
                    </ul>
                </li>
                <!-- Search bar -->
                <li class="nav-item col-md-6 container-fluid align-self-center mx-0">
                    <form class="d-flex" role="search">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Buscar..." aria-label="Search">
                            <button class="btn my-secondary " type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </li>
                <div class="d-md-flex ms-md-auto align-items-center">
                    <!-- Profile -->
                    <li class="nav-item dropdown d-flex justify-content-center">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="assets/no-profile-user.png" alt="Profile" height="25 rem">
                            Perfil
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Mensajes</a></li>
                            <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <!-- My purchases -->
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link" href="#">Mis pedidos</a>
                    </li>
                    <!-- My Bookmarks-->
                    <li class="nav-item d-flex justify-content-center">
                        <a class="nav-link" href="#">Mis listas</a>
                    </li>
                    <!-- My notifications -->
                    <li class="nav-item d-flex justify-content-center d-md-none d-md-block">
                        <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
                    </li>
                    <!-- My shopping Cart -->
                    <li class="nav-item d-flex justify-content-center d-md-none d-md-block">
                        <a class="nav-link " href="#"><i class="bi bi-cart"></i></a>
                    </li>
                    
                </div>
            </ul>
        </div>
    </div>
</nav>