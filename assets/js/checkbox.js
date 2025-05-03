document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('input[name="tipos[]"]');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            const checked = Array.from(checkboxes).filter(i => i.checked);
            if (checked.length > 2) {
                checkbox.checked = false; // desmarca el último
                Swal.fire({
                    icon: 'warning',
                    title: 'Máximo dos tipos',
                    text: 'Solo podés seleccionar hasta dos tipos de Pokémon.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});