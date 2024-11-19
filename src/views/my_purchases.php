<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Mis pedidos</title>
</head>
<body>
    <?php
    include __DIR__ . '/layouts/navbar.php';
    ?>
    <!-- Content -->
    <div class="container w-100 h-90">
        <div class="row m-3">
            <h4>Compras</h4>
        </div>
        <div class="d-flex justify-content-start row mb-3">
            <div class="col-8">
                <form method="POST" action="index.php?controller=report&action=userOrders">
                    <div class="row d-flex align-items-start mb-3">
                        <div class="col-6">
                            <label for="start_date">Fecha de Inicio:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($startDate); ?>">
                        </div>
                        <div class="col-6">
                            <label for="end_date">Fecha Final:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($endDate); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col ">
                            <select class="form-select" id="category" name="category">
                                <option value="">Todas las categorias</option>
                                <?php
                                    foreach($categories as $category)
                                    {
                                        if($category['category_id'] === $form_category)
                                        {
                                            echo "<option selected value=". $category['category_id'] .">". $category['title'] ."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=". $category['category_id'] .">". $category['title'] ."</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>                        
                    </div>
                    <div class="row mb-3">
                        <div class="col d-flex justify-content-start">
                            <button class="btn my-primary" type="submit">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="card" >
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Fecha y hora de compra</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Calificacion</th>
                            <th scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($orders))
                            {
                                foreach($orders as $order)
                                {
                                    echo "<tr>";
                                        echo "<td>". $order['sale_datetime']  ."</td>";
                                        echo "<td>". $order['category'] ."</td>";
                                        echo "<td>". $order['product_name'] ."</td>";
                                        echo "<td>". $order['rate'] ."</td>";
                                        echo "<td>". $order['individual_price'] ."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>  
            </div>
                      
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

