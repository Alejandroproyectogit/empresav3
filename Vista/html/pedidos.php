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

    <!-- Incluir jQuery desde CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir jQuery UI desde CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="Vista/js/main.js"></script>

    <!-- Incluir DATATABLES desde CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Enlaza el archivo CSS de Leaflet desde el CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i> El Sabor Tolimense</h1>
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
                        <a href="index.php?accion=pedidos" class="nav-item nav-link active">PEDIDOS</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown active">INVENTARIO</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php?accion=entradas" class="dropdown-item">ENTRADAS</a>
                                <a href="index.php?accion=productos" class="dropdown-item">PRODUCTOS</a>
                            </div>
                        </div>
                    </div>
                    <a href="index.php?accion=login" class="btn btn-primary py-2 px-4">CERRAR SESION</a>
                </div>
            </nav>
            <div class="container-fluid py-5 bg-dark hero-header-diferente">
                <div class="container py-5">
                    <div class="row g-5">
                        <div class="col-lg-12 text-center">
                            <form action="">
                                <h1 class="text-center">Gestión de Pedidos</h1>
                                <div class="mb-3 bg-light">
                                    <table id="Tabla_Pedidos" class="table table-striped table-bordered" style="background: rgba(255, 255, 255, 0.9); color: #333;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>N° Pedido</th>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Fecha</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($resultPedidos) {
                                                foreach ($resultPedidos as $pedido) {
                                                    echo "<tr>";
                                                    echo "<td>" . $pedido["ped_id"] . "</td>";
                                                    echo "<td>" . $pedido["nombre_cliente"] . " - " . $pedido["direccion_cliente"] . "</td>";
                                                    echo "<td>" . $pedido["nombre_receta"] . "</td>";
                                                    echo "<td>" . $pedido["ped_paquetes"] . "</td>";
                                                    echo "<td>" . $pedido["ped_fecha"] . "</td>";
                                                    echo "<td>" . "$" . $pedido["ped_valor"] . "</td>";
                                                    echo "<td>" . $pedido["ped_estado"] . "</td>";
                                                    echo "<td>";
                                                    // Botón Editar
                                                    echo "<button type='button' class='btn btn-outline' data-bs-toggle='modal' data-bs-target='#modalEditarPedido' data-id='" . $pedido['ped_id'] . "' data-cliente='" . $pedido['nombre_cliente'] . "' data-receta='" . $pedido['nombre_receta'] . "' data-paquetes='" . $pedido['ped_paquetes'] . "' data-fecha='" . $pedido['ped_fecha'] . "' data-valor='" . $pedido['ped_valor'] . "' data-estado='" . $pedido['ped_estado'] . "'><i class='bi bi-brush'></i></button>";
                                                    // Botón Mapa
                                                    echo "<div class='btn btn-outline btn-sm btn-buscar' data-direccion='" . htmlspecialchars($pedido['nombre_cliente']) . "'><i class='bi bi-geo-alt'></i></div>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>No hay pedidos</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Botón para agregar pedidos -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarPedido">Agregar Pedido</button>
                        </div>
                        <div id="mapa" class="col-lg-12" style="height: 500px;"></div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar pedidos -->
            <div class="modal fade" id="modalAgregarPedido" tabindex="-1" aria-labelledby="modalAgregarPedidoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarPedidoLabel">Registrar Nuevo Pedido</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="agregarPedido" action="index.php?accion=ingresarPedido" method="post">
                                <div class="mb-3">
                                    <label for="cliente">Cliente:</label>
                                    <select class="form-control" id="PedCliente" name="PedCliente" required>
                                        <option value="">Seleccione un cliente</option>
                                        <?php
                                        if ($resultClientes) {
                                            foreach ($resultClientes as $cliente) {
                                                echo "<option value='" . $cliente['cli_id'] . "'>" . $cliente["cli_nombre"] . " - " . $cliente["cli_direccion"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="producto">Producto:</label>
                                    <select class="form-control" id="PedReceta" name="PedReceta" required>
                                        <option value="">Seleccione una Receta</option>
                                        <?php
                                        if ($resultReceta) {
                                            foreach ($resultReceta as $receta) {
                                                echo "<option value='" . $receta["rec_id"] . "'>" . $receta["rec_nombre"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" class="form-control" id="PedPaquetes" name="PedPaquetes" required>
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" id="PedFecha" name="PedFecha" required>
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" id="PedValor" name="PedValor" readonly>
                                    <label for="precio">Estado:</label>
                                    <select class="form-control" id="PedEstado" name="PedEstado" required>
                                        <option value="Por Entregar">Por Entregar</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                        <div id="mapa" class="col-lg-5" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalEditarPedido" tabindex="-1" aria-labelledby="modalEditarPedido" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarPedido">Editar Pedido</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="formularioEditarPedido" title="Editar Pedido">
                                <form id="editarPedido" action="index.php?accion=editarPedido" method="post">
                                    <div class="mb-3">
                                        <label for="idPedido">Id</label>
                                        <input type="text" class="form-control" id="idPedido" name="idPedido" readonly>

                                        <label for="paquetes">Cantidad:</label>
                                        <input type="number" class="form-control" id="PedPaquetes" name="PedPaquetes" required>

                                        <label for="valor">Precio:</label>
                                        <input type="number" class="form-control" id="PedValor" name="PedValor" readonly>

                                        <label for="estado">Estado:</label>
                                        <select class="form-control" id="PedEstado" name="PedEstado" required>
                                            <option value="Por Entregar">Por Entregar</option>
                                            <option value="Entregado">Entregado</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="guardarCambios">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- JavaScript Libraries -->
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
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

            <!-- Template Javascript -->
            <script>
                $(document).ready(function() {
                    $('#Tabla_Pedidos').DataTable({
                        "lengthMenu": [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "Todos"]
                        ]
                    });
                });

                document.getElementById('PedPaquetes').addEventListener('input', function() {
                    var cantidad = parseInt(this.value);
                    var precio = cantidad * 32000;
                    document.getElementById('PedValor').value = isNaN(precio) ? '' : precio;
                });

                // Manejar el evento de mostrar el modal
                var modalEditarPedido = document.getElementById('modalEditarPedido');
                modalEditarPedido.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget; // Botón que disparó el modal
                    var id = button.getAttribute('data-id');
                    var cliente = button.getAttribute('data-cliente');
                    var receta = button.getAttribute('data-receta');
                    var paquetes = button.getAttribute('data-paquetes');
                    var valor = button.getAttribute('data-valor');
                    var estado = button.getAttribute('data-estado');

                    // Actualiza los campos del formulario en el modal
                    var modalBodyInputId = modalEditarPedido.querySelector('#idPedido');
                    var modalBodyInputCliente = modalEditarPedido.querySelector('#PedCliente');
                    var modalBodyInputReceta = modalEditarPedido.querySelector('#PedReceta');
                    var modalBodyInputPaquetes = modalEditarPedido.querySelector('#PedPaquetes');
                    var modalBodyInputValor = modalEditarPedido.querySelector('#PedValor');
                    var modalBodyInputEstado = modalEditarPedido.querySelector('#PedEstado');

                    modalBodyInputId.value = id;
                    modalBodyInputCliente.value = cliente;
                    modalBodyInputReceta.value = receta;
                    modalBodyInputPaquetes.value = paquetes;
                    modalBodyInputValor.value = valor;
                    modalBodyInputEstado.value = estado;

                    // Calcular el precio basado en la cantidad ingresada
                    modalBodyInputPaquetes.addEventListener('input', function() {
                        var cantidad = parseInt(this.value);
                        var precio = cantidad * 32000; // Precio fijo de 32000 por paquete
                        modalBodyInputValor.value = isNaN(precio) ? '' : precio;
                    });
                });

                // Validar los campos al hacer clic en el botón de guardar
                document.getElementById('guardarCambios').addEventListener('click', function(event) {
                    var paquetes = document.getElementById('PedPaquetes').value;
                    var estado = document.getElementById('PedEstado').value;

                    if (!paquetes || !estado) {
                        alert('Los campos de Cantidad y Estado deben estar llenos');
                        event.preventDefault(); // Previene el envío del formulario
                    }
                });

                // Inicializa el mapa con Leaflet
                var mapa = L.map('mapa').setView([4.438889, -75.232222], 13); // Centra el mapa en Ibagué, Colombia, y establece el nivel de zoom

                // Añade una capa base de OpenStreetMap al mapa
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(mapa);

                setTimeout(function() {
                    mapa.invalidateSize();
                }, 100);
            </script>
</body>
  
</html>