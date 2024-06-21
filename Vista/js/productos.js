$(document).ready(function() {
    $('#agregarProductos').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario inmediato

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: '¿Estás seguro?',
            text: '¡Vas a agregar un nuevo producto al sistema!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, confirmar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    '¡Confirmado!',
                    'El Producto ha sido guardado.',
                    'success'
                ).then(() => {
                    // Enviar el formulario después de la confirmación
                    e.target.submit();
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La operación ha sido cancelada.',
                    'error'
                );
            }
        });
    });
});

$(document).ready(function() {
    function alertUpdateprod(){
        $('[id^=actualizarProducto').on('submit', function(e) {
            e.preventDefault(); // Evitar el envío del formulario inmediato

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: '¡Vas a modificar la informacion del producto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, confirmar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        '¡Confirmado!',
                        'La información ha sido modificada.',
                        'success'
                    ).then(() => {
                        // Enviar el formulario después de la confirmación
                        e.target.submit();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La operación ha sido cancelada.',
                        'error'
                    );
                }
            });
        })};
        
        alertUpdateprod();
});