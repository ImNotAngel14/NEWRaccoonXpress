<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Productos</title>
</head>
<body>
    <?php
    include __DIR__ . '/layouts/navbar.php';
    ?>
    <!-- Content -->
    <div class="container w-100 h-90">
        <div class="row justify-content-center align-items-center w-100">
            <div class="col-sm-12 col-md-8 col-lg-6 m-5">
                <div class="card">
                    <div class="card-header text-center p-4 my-primary-color">
                        <h3>Crear producto</h3>
                    </div>
                    <div class="card-body m-4">
                        <form method="POST" id="add_product" enctype="multipart/form-data"  >

                            <!-- product_name -->
                            <div class="form-outline mb-3">
                                <label for="product_name" class="form-label">Nombre del producto:</label>
                                <input type="text" class="form-control p-2" id="product_name" name="product_name" placeholder="Nombre del producto" required/>
                                <div class="invalid-feedback">Ingrese el nombre del producto.</div>
                            </div>

                            <!-- description -->
                            <div class="form-outline mb-3">
                                <label for="description" class="form-label">Descripción del producto:</label>
                                <input type="text" class="form-control p-2" id="description" name="description" placeholder="Descripción" required/>
                                <div class="invalid-feedback">Descripción del producto.</div>
                            </div>

                            <!-- quotable -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="quotable" id="quotable">
                                <label class="form-check-label" for="persistent">¿Es un producto cotizable?</label>
                            </div>

                            <!-- price -->
                            <div class="form-outline mb-3" id="price-container">
                                <label for="price" class="form-label">Precio del producto:</label>
                                <input type="number" class="form-control p-2" id="price" name="price" placeholder="Precio del producto" min="0"/>
                                <div class="invalid-feedback">Ingrese el precio del producto</div>
                            </div>

                            <!-- quantity -->
                            <div class="form-outline mb-3" id="quantity-container">
                                <label for="quantity" class="form-label">Cantidad del producto:</label>
                                <input type="number" class="form-control p-2" id="quantity" name="quantity" placeholder="Cantidad disponible" min="0"/>
                                <div class="invalid-feedback">Cantidad disponible</div>
                            </div>

                            <!-- category -->
                            <label for="category" class="form-label">Categoria del producto:</label>
                            <select class="form-select mb-3" id="category" name="category" required>
                                <option value="">Todas las categorias</option>
                                <?php
                                    if(isset($categories))
                                    {
                                        foreach($categories as $category)
                                        {
                                            echo "<option value=". $category['category_id'] .">". $category['title'] ."</option>";
                                        }
                                    } 
                                ?>
                            </select>
                            <button id='id_delete_account' class='btn my-secondary m-2' data-bs-toggle='modal' data-bs-target='#modal_create_category'>Crear categoria</button>

                            <!-- image_1 -->
                            <div class="mb-3">
                                <label class="form-label">Imagen 1</label>
                                <input type="file" class="form-control" id="image_1" name="image_1" accept=".jpg">
                            </div>

                            <!-- image_2 -->
                            <div class="mb-3">
                                <label class="form-label">Imagen 2</label>
                                <input type="file" class="form-control" id="image_2" name="image_2" accept=".jpg">
                            </div>

                            <!-- image_3 -->
                            <div class="mb-3">
                                <label class="form-label">Imagen 3</label>
                                <input type="file" class="form-control" id="image_3" name="image_3" accept=".jpg">
                            </div>

                            <!-- video -->
                            <div class="mb-3">
                                <label class="form-label">Video</label>
                                <input type="file" class="form-control" id="video" name="video" accept=".webm">
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn w-100 my-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_create_category"  tabindex="-1" aria-labelledby="ModalmodifieLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card">
                    <div class="card-body m-4">
                        <form method="POST" id="add_category" action="index.php?controller=category&action=create" >

                            <!-- category_name -->
                            <div class="form-outline mb-3">
                                <label for="category_name" class="form-label">Nombre de la categoría:</label>
                                <input type="text" class="form-control p-2" id="category_title" name="category_title" placeholder="Titulo de la categoria" required/>
                                <div class="invalid-feedback">Ingrese el nombre de la categoría.</div>
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn w-100 my-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Selecciona el checkbox y los contenedores de los campos
        const quotableCheckbox = document.getElementById('quotable');
        const priceContainer = document.getElementById('price-container');
        const quantityContainer = document.getElementById('quantity-container');

        // Agrega un evento al checkbox para detectar cambios
        quotableCheckbox.addEventListener('change', function () {
            if (this.checked) {
                // Si está marcado, oculta los campos
                priceContainer.style.display = 'none';
                quantityContainer.style.display = 'none';
            } else {
                // Si no está marcado, muestra los campos
                priceContainer.style.display = '';
                quantityContainer.style.display = '';
            }
        });

        const modal_form = document.getElementById('add_category');
        form.addEventListener('submit', async function(event){
            event.preventDefault();
        });

        const form = document.getElementById('add_product');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            //form.classList.add('was-validated');
            if (form.checkValidity())
            {
                const formData = new FormData(this);
                try {
                    const response = await fetch("http://localhost/NewRaccoonXpress/index.php?controller=product&action=addProduct", {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();
                    console.log(result);
                    if (result.success) 
                    {
                        
                    } 
                    else 
                    {
                        // Mostrar mensaje de error
                        alert('no registrado');
                        console.error("Error al actualizar la cuenta: ", response.statusText);
                    }
                } catch (error) {
                    console.log("Error:", error);
                }
            }        
        }, false);
    </script>
</body>
</html>

