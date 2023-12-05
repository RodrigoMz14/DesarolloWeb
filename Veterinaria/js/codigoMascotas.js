function iniciarProceso(idMascota) {

    // Realizar la solicitud AJAX para enviar datos a PHP y obtener respuesta
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parsear el JSON recibido
            var datosMascota = JSON.parse(xhr.responseText);

            // Llamar a otra función de JavaScript con los datos obtenidos
            cargarInfo(datosMascota);
        }
    };

    // Realizar la solicitud POST a codigoMascotas.php y enviar el valor
    xhr.open('POST', '../js/codigoMascotas.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('valor=' + encodeURIComponent(idMascota));
}

function cargarInfo(datosMascota) {

    var divIframe = document.getElementById("divInfoMascotas");
    divIframe.innerHTML = "<iframe id='iframeMascotas' src='infoMascota.php' width='100%' height='1000px' frameborder='no' scrolling='yes' style='border: 1px solid black'>";

    var iframe = document.getElementById("iframeMascotas");

    iframe.onload = function () {
        var iframeDocument = iframe.contentDocument;

        iframeDocument.getElementById("nombMascota").innerText = datosMascota.nombreMascota;

        iframeDocument.getElementById("infoMascota_Nombre").innerText = datosMascota.nombreMascota;
        iframeDocument.getElementById("infoMascota_Edad").innerText = "Tiene la edad de: " + datosMascota.Edad;
        iframeDocument.getElementById("infoMascota_Sexo").innerText = "Es : " + datosMascota.Sexo;
        iframeDocument.getElementById("infoMascota_Especie").innerText = "Pertenece a la especie: " + datosMascota.Especie;
        iframeDocument.getElementById("infoMascota_Raza").innerText = "Pertenece a la raza: " + datosMascota.Raza;

        iframeDocument.getElementById("divImgMascota").innerHTML = "<img src='" + datosMascota.Imagen + "' width='300px'></img>";

        iframeDocument.getElementById("notasVet").innerText = datosMascota.NotasVet;
    }
}