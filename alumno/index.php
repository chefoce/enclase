<!-- Head -->
<?php include('partials/head1.php'); ?>
<title>ENCLASE - Inicio Alumno</title>
<?php include('partials/head2.php'); ?>
<!-- Sidebar -->
<?php include('partials/sidebar.php'); ?>
<!-- Navbar -->
<?php include('partials/navbar.php'); ?>

<!-- Main -->
<main>
    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>
    <?php
    $sql2 = "SELECT dm_id FROM alumno_docente WHERE alumno_id = $id_alumno";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2 == TRUE) {
        $count2 = mysqli_num_rows($result2);
        if ($count2 > 0) {
            while ($rows2 = mysqli_fetch_assoc($result2)) {
                $dm_id = $rows2['dm_id'];
                $sql3 = "SELECT grupo_id FROM docente_materia WHERE id_dm = $dm_id";
                $result3 = mysqli_query($conn, $sql3);
                if ($result3 == TRUE) {
                    $count3 = mysqli_num_rows($result3);
                    if ($count3 > 0) {
                        while ($rows3 = mysqli_fetch_assoc($result3)) {
                            $grupo_id = $rows3['grupo_id'];
                            $_SESSION['grupo'] = $grupo_id;
                            $sql4 = "SELECT e.id_evento,
                                            e.titulo,
                                            e.color,
                                            e.inicio,
                                            e.fin,
                                            CONCAT(d.nombre, ' ', d.apellido) AS nombre_docente,
                                            m.nombre AS materia
                                    FROM eventos e
                                    JOIN docente d ON e.docente_id = d.id_docente
                                    JOIN docente_materia dm ON e.dm_id = dm.id_dm
                                    JOIN materia m ON dm.materia_id = m.id_materia
                                    WHERE e.grupo_id = $grupo_id";
                            $result4 = $conn->prepare($sql4);
                            $result4->execute();
                            $resultSet = $result4->get_result();
                            $events = $resultSet->fetch_all(MYSQLI_ASSOC);
                            $sql5 = "SELECT id_evento,titulo,color,inicio,fin FROM eventos WHERE grupo_id = $grupo_id AND rol_autor = 'admin'";
                            $result5 = $conn->prepare($sql5);
                            $result5->execute();
                            $resultSet2 = $result5->get_result();
                            $events2 = $resultSet2->fetch_all(MYSQLI_ASSOC);
                        }
                    }
                }
            }
        }
    }
    ?>
    <div class="container-fluid mb-5">
        <section>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h2 class="display-4 verde-conalep text-white mb-1">Mis Eventos</h2>
                                <div id="calendar" class="col-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<!-- Main -->

<?php include('partials/footer.php'); ?>