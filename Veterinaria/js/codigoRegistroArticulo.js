$(document).ready(function () {
    // Manejo del formulario de registro
    $("#articuloForm").submit(function (event) {
        event.preventDefault();

        // Validar archivo
        if (!validateFile()) {
            alert("Por favor, selecciona un archivo de imagen válido (JPG, JPEG, PNG, GIF).");
            return;
        }
        // Obtener datos del formulario
        var formData = new FormData(this);

        //Enviar datos a PHP 
        $.ajax({
            url: 'funcionesCrudArticulo.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Manejar la respuesta del servidor si es necesario
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Otras funciones JS para eliminar, cargar datos, etc.

    function validateFile() {   
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var fileInput = $("#File_imagen");
        var fileName = fileInput.val();   

        return allowedExtensions.test(fileName);
    }
});
