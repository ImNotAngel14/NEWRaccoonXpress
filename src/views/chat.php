<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Productos</title>
</head>
<body>
    <div class="container-fluid d-flex flex-column w-100 vh-100">    
        <div class="row">
            <?php
                include __DIR__ . '/layouts/navbar.php';
            ?>
        </div>
        <!-- Content -->
        <div class="row justify-content-center align-items-start p-2 gx-2 flex-grow-1">
            <div class="col-3 h-100">
                <scroll-container class="w-100 h-100">
                    <div class="card my-3 me-2" style="height: 10vh;">
                        <div class="row w-100">
                            <div class="col-md-4">
                                <img src="..." class="img-fluid object-fit-scale border rounded" alt="..." style=" height: 10vh;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body ">
                                    <h5 class="card-title">Producto</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Vendedor</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </scroll-container>
            </div>
            <div class="col-9 h-100">
                <scroll-container class="w-100" style="height: 90%">
                    <ul class="list-unstyled" >
                        <li class="d-flex justify-content-start mb-4">
                            <img src="..." alt="avatar"
                            class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <div class="card">
                            <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">Brad Pitt</p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.
                                </p>
                            </div>
                            </div>
                        </li>
                    </ul>
                </scroll-container>
                <div class="input-group" style="height: 10%">
                    <input type="hidden" name="controller" value="search">
                    <input type="hidden" name="action" value="search">
                    <input class="form-control" type="search" placeholder="Mensaje..." aria-label="Search" name='search'>
                    <button class="btn my-secondary " type="submit"><i class="bi bi-send"></i></button>
                </div>                             
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<style>
    scroll-container {
  display: block;
  width: 350px;
  height: auto;
  overflow-y: scroll;
  scroll-behavior: smooth;
}
</style>
