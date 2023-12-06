function redirigirPagina(numPagina, filtrosURL) {
    var filtrosActuales = obtenerFiltrosSeleccionados();
    var paginaActual = numPagina || obtenerNumeroPaginaActual();

    // Combinar los filtros actuales con los filtros de la URL
    var filtrosCombinados = { ...filtrosActuales, ...filtrosURL };

    var queryString = 'page=' + paginaActual;

    // Agregar filtros a la URL si están presentes
    for (var filtro in filtrosCombinados) {
        if (filtrosCombinados[filtro]) {
            queryString += '&' + filtro + '=' + encodeURIComponent(filtrosCombinados[filtro]);
        }
    }

    // Redirigir a la nueva página con los filtros
    window.location.href = 'articulos.php?' + queryString;
}

function obtenerNumeroPaginaActual() {
    // Obtener el número de página actual de la URL
    var urlParams = new URLSearchParams(window.location.search);
    return parseInt(urlParams.get('page')) || 1;
}

/*
    Funciones para el filtro de productos
 */
function obtenerFiltrosSeleccionados(){
    var filtrosSeleccionados = {};

    document.querySelectorAll('input[type="checkbox"]:checked').forEach(function (checkbox) {
        filtrosSeleccionados[checkbox.name] = checkbox.value;
    });

    return filtrosSeleccionados;
}

function filtrarArticulos(){
    var filtros = obtenerFiltrosSeleccionados();
    var queryString = '';

    // Agregar filtros a la URL si están presentes
    for (var filtro in filtros) {
        if (filtros[filtro]) {
            queryString += '&' + filtro + '=' + encodeURIComponent(filtros[filtro]);
        }
    }

    // Redirigir a la primera página con los filtros aplicados
    redirigirPagina(1);
}

function deseleccionar(checkbox) {
    // Desmarcar todas las casillas de verificación dentro del mismo grupo
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="' + checkbox.name + '"]');
    checkboxes.forEach(function(cb) {
        if (cb !== checkbox) {
            cb.checked = false;
        }
    });
}

/*
    Funcion para guardar los productos a carrito de compras
*/

