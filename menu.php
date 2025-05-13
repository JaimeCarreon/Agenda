<nav>
    <?php
    if (isset($_SESSION["tipo"])) {
        if ($_SESSION["tipo"] == "Administrador") {
            // Menú para administrador
            ?>
            <ul>
                <li><a href="visualizarContactos.php" class="menu">Contactos</a></li>
                
                <li><a href="logout.php" class="menu">Salir</a></li>
            </ul>
            <?php
        } else {
            // Menú para otros usuarios
            ?>
            <ul>
                <li><a href="visualizarContactos.php" class="menu">Contactos</a></li>
                <li><a href="logout.php" class="menu">Salir</a></li>
            </ul>
            <?php
        }
    } 
        // Menú para visitantes no logueados
        ?>
        
</nav>
