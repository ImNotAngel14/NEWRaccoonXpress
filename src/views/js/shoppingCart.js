document.addEventListener("DOMContentLoaded", () => {
    const cartContainer = document.getElementById("cart-items");

    cartContainer.addEventListener("click", (event) => {
        if (event.target.classList.contains("quantityUp") || event.target.classList.contains("quantityDown")) {
            const productId = event.target.getAttribute("data-product-id");

            console.log("Producto clickeado:", productId);
            var operation = 1;
            if(event.target.classList.contains("quantityUp"))
            {
                operation = 1;
            }
            else
            {
                operation = 0;
            }
            const input = document.querySelector(`input[data-product-id="${productId}"]`);
             
            fetch("http://localhost/NewRaccoonXpress/api/shoppingCartAPI.php?action=handleItemQuantity", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `product_id=${productId}&operation=${operation}`
            })
                .then((response) => response.json())
                .then((result) => {
                    if (result.success) {
                        if (input) 
                        {
                            input.value = operation ? parseInt(input.value) + 1 : parseInt(input.value) - 1;
                            if(input.value == 0)
                            {
                                location.reload();
                            }
                        }
                        else
                        {
                            console.error(`No se encontró un input para el producto con ID ${productId}`);
                        }
                        
                    } else {
                        alert("Error: " + result.message);
                    }
                })
                .catch((error) => {
                    console.error("Error al incrementar cantidad:", error);
                });
        }
    });
});


