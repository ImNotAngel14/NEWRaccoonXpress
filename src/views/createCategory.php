<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <title>Crear categoria</title>
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
                        <h3>Crear categoria</h3>
                    </div>
                    <div class="card-body m-4">
                        <form method="POST" id="add_category" enctype="multipart/form-data"  >

                            <!-- category_name -->
                            <div class="form-outline mb-3">
                                <label for="category_name" class="form-label">Nombre de la categoría:</label>
                                <input type="text" class="form-control p-2" id="category_name" name="category_name" placeholder="Nombre de la categoria" required/>
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

