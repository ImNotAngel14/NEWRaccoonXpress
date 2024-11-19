<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . '/layouts/general_header.php';
    ?>
    <link rel="stylesheet" href="/NewRaccoonXpress/src/views/css/landing_page.css">
    <title>Inicio</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <!-- Content -->
        <div class="container">

            <section class="cta">
                <h2><a href="index.php?controller=user&action=showRegister" class="btn-cta">Registrate ahora</a></h2>
                <p>Vive la experiencia completa</p>
                <br>
                <p style="color: #494949;">¿Ya tienes una cuenta? &nbsp;</p>
                <span class="link"><a href="index.php?controller=user&action=showLogin" style="color: lightskyblue;">Inicia Sesión</a><span>
            </section>

            <!-- <h1 id="watchme">Watch me move</h1> -->

            <div class="beneficio d-flex fadeIn">
                <div class="beneficio_img">
                    <img src="/NewRaccoonXpress/src/views/assets/Imagen2.jpg" alt="Beneficio 1">
                </div>
                <div class="beneficio_texto" style="padding-left: 1.5rem;">
                    <h2>Calidad Garantizada</h2>
                    <p>Nuestros productos son de la más alta calidad para satisfacer tus necesidades.</p>
                </div>
            </div>       

            <div class="frase_atractiva watchme-styling" id="watchme">
                <p>"Descubre la calidad que mereces."</p>
            </div>

            <div class="beneficio d-flex">
                <div class="beneficio_img">
                    <img src="/NewRaccoonXpress/src/views/assets/envio.jpg" alt="Beneficio 2">
                    </div>
                <div class="beneficio_texto" style="padding-left: 1.5rem;">
                    <h2>Envío Rápido</h2>
                    <p>Entregamos tus productos de manera rápida y segura a tu puerta.</p>
                </div>

            </div>

            <div class="frase_atractiva" id="watchme">
                <p>"Comprar con nosotros es una experiencia única."</p>
            </div>

            <div class="beneficio d-flex">
                <div class="beneficio_img">
                    <img src="/NewRaccoonXpress/src/views/assets/servcliente.jpg" alt="Beneficio 3">
                </div>
                <div class="beneficio_texto" style="padding-left: 1.5rem;">
                    <h2>Atención al Cliente</h2>
                    <p>Nuestro equipo de soporte está disponible para ayudarte en cualquier momento.</p>
                </div>
            </div>
        </div>
    </div>
    <section class="cta">
        <h2>¡Explora Nuestra Colección!</h2>
        <p>Encuentra los productos que se adaptan a tus necesidades y disfruta de la mejor calidad.</p>
    </section>
    <br>
    <footer>
        <p>Derechos de Autor &copy; 2023. PWCI. Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>