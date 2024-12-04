<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Mis productos</title>
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
