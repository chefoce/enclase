<?php
$id_admin = $_SESSION['id_sesion'];
?>
<!-- Navbar -->
 <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

   <!-- SideNav slide-out button -->
   <div class="float-left">
     <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
   </div>

   <!-- Breadcrumb -->
   <div class="breadcrumb-dn mr-auto text-white">
     <p>Plantel CONALEP Escuinapa 317</p>
   </div>

   <div class="d-flex change-mode text-white">

     <div class="ml-auto mb-0 mr-3 change-mode-wrapper">
       <button class="btn btn-outline-light btn-sm" id="dark-button">Modo Oscuro</button>
       <button class="btn btn-outline-light btn-sm" id="light-button" hidden>Modo Claro</button>
     </div>

     <!-- Navbar links -->
     <ul class="nav navbar-nav nav-flex-icons ml-auto">

       <!-- Dropdown -->
       <li class="nav-item">
        <a class="nav-link waves-effect" href="soporte.php"><i class="far fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Soporte</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
        if ($_SESSION['imagen_perfil'] != "") {
          ?><img src="../img/img_perfil/<?php echo $_SESSION['imagen_perfil']; ?>"class="rounded-circle z-depth-1" style="width: 2rem;" /></i><?php
        } else {
          ?><i class="fas fa-user"></i> <?php
        }
        ?>
          <span class="clearfix d-none d-sm-inline-block">
            <?php if (isset($_SESSION['nombre_sesion'])){echo $_SESSION['nombre_sesion'];} else { echo 'Perfil';} ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="perfil.php">Mi Cuenta</a>
          <a class="dropdown-item" href="../logout.php">Cerrar Sesión</a>
          
        </div>
     </ul>
     <!-- Navbar links -->

   </div>

 </nav>
 <!-- Navbar -->


 </header>
 <!-- Main Navigation -->