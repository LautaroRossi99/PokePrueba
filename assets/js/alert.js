document.querySelectorAll('.form-eliminar').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita que se envíe directamente

        var pokemonNombre = form.getAttribute('data-pokemon-nombre');

        Swal.fire({
            title: '¿Estás seguro que quiere eliminar a ' + pokemonNombre + '?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger', // Cambia el color del botón "Sí, eliminar" a rojo
                cancelButton: 'btn btn-secondary' // Cambia el color del botón "Cancelar" a gris
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Ahora sí se envía
            }
        });
    });
});