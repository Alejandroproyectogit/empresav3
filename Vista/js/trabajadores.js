$(document).ready(function() {
    $('#agregarPersonal').on('submit', function(e) {
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
            text: '¡Vas a agregar un nuevo usuario al sistema!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, confirmar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    '¡Confirmado!',
                    'El Usuario ha sido guardado.',
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
    // Función para añadir los listeners de eventos a los formularios de actualización
    function alertUpdate() {
        $('[id^=actualizarUsuario]').on('submit', function(e) {
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
                text: '¡Vas a modificar la información de un usuario del sistema!',
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
        });
    }

    alertUpdate();
});
