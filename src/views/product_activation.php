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
        <div class="row flex-grow-1">
            <div class="align-self-start p-5">
                <h3 class="my-3">Productos que requieren activación</h3>
                <table class="table">
                    <tr>
                        <th>Vendedor</th>
                        <th>Producto</th>
                        <th>Categoria</th>
                        <th>Producto cotizable</th>
                    </tr>
                    <tr>
                        <td>Alfreds Futterkiste</td>
                        <td>Maria Anders</td>
                        <td>Germany</td>
                        <td>Germany</td>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
