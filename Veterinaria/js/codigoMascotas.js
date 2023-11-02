document.onload = () => {
    
}

function cargarInfo(Mascota){
    
    var iframe = document.getElementById("iframeMascotas");
    var iframeDocument = iframe.contentDocument;

    iframeDocument.getElementById("nombMascota").innerText = Mascota;
    iframeDocument.getElementById("divImgMascota").innerHTML = "<img src='../recursos/" + Mascota + ".jpg' width='300px'></img>";

    iframeDocument.getElementById("infoMascota_Nombre").innerText = Mascota;
    iframeDocument.getElementById("infoMascota_Edad").innerText = "Tiene la edad de: " + Mascota;
    iframeDocument.getElementById("infoMascota_Sexo").innerText = "Es : " +  Mascota;
    iframeDocument.getElementById("infoMascota_Especie").innerText = "Pertenece a la especie: " +  Mascota;
    iframeDocument.getElementById("infoMascota_Raza").innerText = "Pertenece a la raza: " +  Mascota;

    iframeDocument.getElementById("notasVet").innerText = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates perferendis quis qui labore recusandae, perspiciatis unde officia commodi ipsam aspernatur, similique quisquam alias nisi vero exercitationem et. Numquam, quae voluptatibus.";
}