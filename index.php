<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HogarCauca | Encuentra tu próximo hogar</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-content">
            <a href="index.php" class="logo">Hogar<span>Cauca</span></a>
            <nav class="nav-menu">
                <a href="properties/index.php?operation=venta">Comprar</a>
                <a href="properties/index.php?operation=arriendo">Arrendar</a>
                <a href="properties/create.php">Publicar inmueble</a>
                <a href="auth/login.php" class="btn-login">Iniciar sesión</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-overlay">
                <div class="hero-content">
                    <h1>Encuentra el lugar<br>de tus sueños</h1>
                    <p>Compra, arrienda o publica tu propiedad de manera fácil y segura.</p>

                    <form action="properties/index.php" method="GET" class="search-box">
                        <div class="search-field">
                            <label for="operation">Operación</label>
                            <select name="operation" id="operation">
                                <option value="">Todas</option>
                                <option value="venta">Comprar</option>
                                <option value="arriendo">Arrendar</option>
                            </select>
                        </div>

                        <div class="search-field">
                            <label for="type">Tipo de inmueble</label>
                            <select name="type" id="type">
                                <option value="">Todos</option>
                                <option value="casa">Casa</option>
                                <option value="apartamento">Apartamento</option>
                                <option value="lote">Lote</option>
                                <option value="local">Local comercial</option>
                            </select>
                        </div>

                        <div class="search-field">
                            <label for="city">Ubicación</label>
                            <input type="text" name="city" id="city" placeholder="Ej. Popayán">
                        </div>

                        <button type="submit" class="btn-search">Buscar</button>
                    </form>
                </div>
            </div>
        </section>

        <section class="featured container">
            <div class="section-header">
                <div>
                    <span class="section-tag">PROPIEDADES</span>
                    <h2>Propiedades destacadas</h2>
                </div>
                <a href="properties/index.php" class="view-all">Ver todas →</a>
            </div>

            <div class="property-grid">
                <article class="property-card">
                    <div class="property-image">
                        <img src="public/images/casas/casa1.jpg" alt="Casa moderna">
                        <span class="property-badge">Venta</span>
                        <button class="favorite" type="button" title="Agregar a favoritos">♡</button>
                    </div>
                    <div class="property-info">
                        <span class="property-type">CASA</span>
                        <h3>Casa moderna en Popayán</h3>
                        <p class="property-location">📍 Popayán, Cauca</p>
                        <div class="property-details">
                            <span> 3 hab.</span>
                            <span> 2 baños</span>
                            <span> 120 m²</span>
                        </div>
                        <strong class="property-price">$280.000.000</strong>
                    </div>
                </article>

                <article class="property-card">
                    <div class="property-image">
                        <img src="public/images/apartamentos/apartamento1.jpg" alt="Apartamento moderno">
                        <span class="property-badge">Venta</span>
                        <button class="favorite" type="button" title="Agregar a favoritos">♡</button>
                    </div>
                    <div class="property-info">
                        <span class="property-type">APARTAMENTO</span>
                        <h3>Apartamento moderno</h3>
                        <p class="property-location">📍 Popayán, Cauca</p>
                        <div class="property-details">
                            <span> 2 hab.</span>
                            <span> 2 baños</span>
                            <span> 75 m²</span>
                        </div>
                        <strong class="property-price">$195.000.000</strong>
                    </div>
                </article>

                <article class="property-card">
                    <div class="property-image">
                        <img src="public/images/casas/casa2.jpg" alt="Casa familiar">
                        <span class="property-badge rent">Arriendo</span>
                        <button class="favorite" type="button" title="Agregar a favoritos">♡</button>
                    </div>
                    <div class="property-info">
                        <span class="property-type">CASA</span>
                        <h3>Casa familiar en conjunto</h3>
                        <p class="property-location">📍 Popayán, Cauca</p>
                        <div class="property-details">
                            <span> 4 hab.</span>
                            <span> 3 baños</span>
                            <span> 150 m²</span>
                        </div>
                        <strong class="property-price">$1.400.000 / mes</strong>
                    </div>
                </article>
            </div>
        </section>

        <section class="publish-section">
            <div class="container publish-content">
                <div>
                    <span class="section-tag">¿TIENES UNA PROPIEDAD?</span>
                    <h2>Publica tu inmueble con nosotros</h2>
                    <p>Llega a cientos de personas que están buscando su próximo hogar.</p>
                </div>
                <a href="properties/create.php" class="btn-publish">Publicar inmueble</a>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-brand">
                <a href="index.php" class="logo">Hogar<span>Cauca</span></a>
                <p>Encuentra tu próximo hogar de manera fácil y segura.</p>
            </div>

            <div class="footer-links">
                <h4>Explorar</h4>
                <a href="properties/index.php?operation=venta">Comprar</a>
                <a href="properties/index.php?operation=arriendo">Arrendar</a>
                <a href="properties/create.php">Publicar</a>
            </div>

            <div class="footer-links">
                <h4>Información</h4>
                <a href="#">Nosotros</a>
                <a href="#">Contacto</a>
                <a href="#">Términos y condiciones</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 HogarCauca. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>