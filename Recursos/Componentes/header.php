
<?php
// Inicia la sesiónsession_start();
// session_start();
?>

<!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/PHP/Vistas/Main.php" class="logo d-flex align-items-center">
            <img src="/assets/img/red-logo.jpeg" alt="">
            <span class="d-none d-lg-block">CLÍNICA RED</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/img/user.png" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">Perfil</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">

                        <h6>
                            <?php echo $_SESSION['nombre'];?>
                        </h6>
                        <span>
                            <?php echo $_SESSION['rol'];?>
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                   <li>
                       <a class="dropdown-item d-flex align-items-center" href="/PHP/Perfil/V_Perfil/V_perfil.php?id=<?php echo $_SESSION['usuario']; ?>">
                            <i class="bi bi-person"></i>
                            <span>Ver Perfil</span>
                       </a>
                    </li> 
                    
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/PHP/Controladores/Logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>