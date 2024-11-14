<?php
    $user_role = $_SESSION['role'];
    $nav_buttons = ""; // Inicializar variable vacía para almacenar los botones

    switch ($user_role) {
        case 0: // Administrator
            $nav_buttons = '
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Gestionar usuarios</a>
                </li>
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Autorizar productos</a>
                </li>';
            break;
        case 1: // Seller
            $nav_buttons = '
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Mis productos</a>
                </li>
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Consultas de ventas</a>
                </li>';
            break;
        case 2: // Buyer
            $nav_buttons = '
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Mis pedidos</a>
                </li>
                <li class="nav-item d-flex justify-content-center">
                    <a class="nav-link" href="#">Mis listas</a>
                </li>
                <li class="nav-item d-flex justify-content-center d-none d-lg-block">
                    <a class="nav-link" href="#"><i class="bi bi-bell"></i></a>
                </li>
                <li class="nav-item d-flex justify-content-center d-none d-lg-block">
                    <a class="nav-link" href="#"><i class="bi bi-cart"></i></a>
                </li>';
            break;
    }
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg h-10">
    <div class="container-fluid d-flex align-items-center">
        <button class="navbar-toggler my-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Phone navbar buttons -->
        <div class="d-flex d-lg-none flex-fill justify-content-around">
            <a class="nav-link mx-2" href="#"><i class="bi bi-person-circle"></i></a>
            <a class="nav-link mx-2" href="#"><i class="bi bi-bell"></i></a>
            <?php 
                if($user_role == 2)
                {
                    echo "<a class='nav-link mx-2' href='#'><i class='bi bi-cart'></i></a>";
                }
            ?>
            
        </div>
        <a class='navbar-brand d-flex justify-content-center' href='../../index.php'>
            <img src='/NewRaccoonXpress/src/views/assets/Imagotipo.png' alt='' style='height: 3rem; object-fit: contain;'>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav container-fluid">
                <!-- Categorys -->
                <li class="nav-item dropdown ms-lg-auto d-flex align-items-center justify-content-center">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php 
                            if($user_role == 2)
                            {
                                echo "<li><a class='dropdown-item' href='#'>Crear categoria</a></li>";
                            }
                        ?>
                        <li><a class="dropdown-item" href="#"><?php echo htmlspecialchars($hola); ?></a></li>
                        <li><a class="dropdown-item" href="#">Ingles</a></li>
                        <li><a class="dropdown-item" href="#">Web development</a></li>
                    </ul>
                </li>
                <!-- Search bar -->
                <li class="nav-item col-lg-6 container-fluid align-self-center mx-0">
                    <form class="d-flex" role="search" method="get" action="search.php">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Buscar..." aria-label="Search" name='search'>
                            <button class="btn my-secondary " type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </li>
                <div class="d-lg-flex ms-lg-auto align-items-center">
                    <!-- Profile -->
                    <li class="nav-item dropdown d-flex justify-content-center d-none d-lg-block">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Profile" class="m-2" style='height: 2rem; object-fit: contain;'>
                            <?php echo htmlspecialchars($username); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">Perfil</a></li>
                            <li><a class="dropdown-item" id="log_out_button">Cerrar sesión</a></li>
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    document.getElementById("log_out_button").addEventListener("click", async function(event) {
                                        event.preventDefault();
                                        try
                                        {
                                            const response = await fetch('http://localhost/NewRaccoonXpress/api/usersAPI.php?action=logout', {
                                                method: "POST"
                                            });
                                            const result = await response.json();
                                            if (result.logout) {
                                                // Redirige al usuario a la página de inicio o de login
                                                window.location.href = "landing_page.php";
                                                localStorage.removeItem('user_id');
                                                localStorage.removeItem('user_role');
                                            } else {
                                                console.error("Error al cerrar sesión:", response.statusText);
                                            }
                                        }
                                        catch (error) {
                                            console.error("Error:", error);
                                        }
                                    });
                                });
                            </script>
                        </ul>
                    </li>
                    <!-- Role Buttons -->
                    <?php echo $nav_buttons; ?>
                </div>
            </ul>
        </div>
    </div>
</nav>