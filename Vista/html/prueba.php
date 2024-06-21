<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="Vista/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Vista/lib/animate/animate.min.css" rel="stylesheet">
    <link href="Vista/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="Vista/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="Vista/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Vista/css/style.css" rel="stylesheet">

    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="container-xxl bg-white p-0">
        


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>El Sabor Tolimense</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.php?accion=principal" class="nav-item nav-link">PRINCIPAL</a>
                        <a href="index.php?accion=trabajadores" class="nav-item nav-link">TRABAJADORES</a>
                        <a href="index.php?accion=clientes" class="nav-item nav-link">CLIENTES</a>
                        <a href="index.php?accion=pedidos" class="nav-item nav-link">PEDIDOS</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown active">INVENTARIO</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php?accion=entradas" class="dropdown-item">ENTRADAS</a>
                                <a href="index.php?accion=productos" class="dropdown-item active">PRODUCTOS</a>
                            </div>
                        </div>
                    </div>
                    <a href="index.php?accion=login" class="btn btn-primary py-2 px-4">CERRAR SESION</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header">
                <div class="container text-center pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Entradas de Productos</h1>
                    <button type="button" id="btnagregarprod" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Newprod">
                        Nuevo Producto
                    </button>
                </div>
                <div class="modal fade" id="Newprod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="agregarPersonal" action="index.php?accion=ingresarProducto" method="post">
                                        <div class="mb-3">
                                            <label for="nombreprod">Nombre:</label>
                                            <input type="text" class="form-control" id="ProdNombre" name="ProdNombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="unidmedida">Unidad de Medida:</label>
                                            <select class="form-select form-select-lg mb-3" aria-label="Large select example" id="unidmedida" name="unidmedida">
                                                <option value="-1" selected="selected">-- Selecione la unidad de medida ---</option>
                                                <option value="Kilogramos">Kilogramos</option>
                                                <option value="Gramos">Gramos</option>
                                                <option value="Unidades">Unidades</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <table id="table" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Unidad de Medida</th>
                            <th scope="col">Total disponible</th>
                            <th scope="col">Total gastado</th>
                            <th scope="col" colspan="2">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if(!empty($producto)): ?>
                        <?php foreach ($producto as $productos) : ?>
                            <tr>
                                <td><?php echo $productos["prod_id"]; ?></td>
                                <td><?php echo $productos["prod_nombre"]; ?></td>
                                <td><?php echo $productos["prod_unidadmedida"]; ?></td>
                                <td><?php echo $productos["prod_total_entrada"]; ?></td>
                                <td><?php echo $productos["prod_total_salidas"]; ?><td>
                                <td><button type="button" id="btneditarprod" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateprodModal<?php echo $productos["prod_id"]; ?>"><i class="bi bi-brush"></i></button></td>
                            </tr>
                            <div class="modal fade" id="updateprodModal<?php echo $productos["prod_id"]; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $productos["prod_id"]; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel<?php echo $productos["prod_id"]; ?>">Actualizar Producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <?php include('form_update_producto.php'); ?>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <div class="col-lg-12 text-center">
                        <?php echo  "<h5>No hay información</h5>";?>
                    </div>
                    <?php endif; ?>
                    </tbody>
                </table>
                
            </div>
        </div>
        

        <!-- JavaScript Libraries -->
         <script>
            var tabla= document.querySelector("#tabla");

            var datatable = new DataTabla(table);
         </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="Vista/lib/wow/wow.min.js"></script>
        <script src="Vista/lib/easing/easing.min.js"></script>
        <script src="Vista/lib/waypoints/waypoints.min.js"></script>
        <script src="Vista/lib/counterup/counterup.min.js"></script>
        <script src="Vista/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="Vista/lib/tempusdominus/js/moment.min.js"></script>
        <script src="Vista/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="Vista/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
        <!-- Template Javascript -->
        <script src="Vista/js/main.js"></script>
</body>

</html>
