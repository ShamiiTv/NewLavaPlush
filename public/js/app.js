document.addEventListener('DOMContentLoaded', function () {
    const tipoRopaDetalle = document.getElementById('tipoRopaDetalle');
    const tipoRopaOtroWrapper = document.getElementById('tipoRopaOtroWrapper');
    const tipoRopaOtro = document.getElementById('tipoRopaOtro');

    tipoRopaDetalle.addEventListener('change', function () {
        if (tipoRopaDetalle.value === 'otro') {
            tipoRopaOtroWrapper.style.display = '';
            tipoRopaOtro.required = true;
        } else {
            tipoRopaOtroWrapper.style.display = 'none';
            tipoRopaOtro.required = false;
        }
    });

    function updateTipoRopaOptions() {
        fetch('/get-tipo-ropa-detalles')
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Selecciona el tipo de prenda</option>';
                data.forEach(item => {
                    options += `<option value="${item}">${item}</option>`;
                });
                tipoPrendaSelect.innerHTML = options;
            });
    }

    updateTipoRopaOptions();
});

