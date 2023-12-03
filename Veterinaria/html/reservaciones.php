<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <link rel="stylesheet" href="../css/estilosIndex.css">   
    <script src = "../js/codigoReservaciones.js"></script>
</head>
<body>
<div id="divPrincipal">
        <header id="ContenedorMenu">
            <ul class="ajustarMenuBarra">
                <li id="botonImg"><a href="Index.html"><img src="../recursos/logoPrincipal.png" alt="Logo del Hospital Veterinario" id="imgLogo"></a></li>
                <li><a href="">Inicio</a></li>
                <li><a href="">Mascotas</a></li>
                <li><a href="">Citas</a></li>
                <li><a href="">Artículos</a></li>
                <li><a href="">Sucursales</a></li>
                <li><a href="">Contacto</a></li>
                <li><a href="">Cuenta</a></li>
            </ul>
        </header>
        <div id="calendar"></div>
        <footer id="ContenedorInferior">
            <div id="menuInferior">
                <h2>Veterinaria</h2>
                <ul>
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Mascotas</a></li>
                    <li><a href="">Citas</a></li>
                    <li><a href="">Artículos</a></li>
                    <li><a href="">Sucursales</a></li>
                    <li><a href="">Contacto</a></li>
                    <li><a href="">Cuenta</a></li>
                </ul>
            </div>
            <div id="infoContacto">
                <h2>Contáctanos (Atención al Cliente)</h2>
                <ul>
                    <li>e-mail:<a href="mailto:clientes_duda@vet.com.mx"> clientes_duda@vet.com.mx</a></li>
                    <li>Tel: 9991014169</li>
                    <li>Fax: 9991014169</li>
                </ul>
            </div>
            <div id="redesSociales">
                <h2>¡Síguenos en nuestras redes sociales!</h2>
                <a href="https://twitter.com/LeagueOfLegends"><img src="../recursos/x.png" alt="X"></a>
                <a href="https://www.instagram.com/nintendoamerica"><img src="../recursos/instagram.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="../recursos/facebook.png" alt="Facebook"></a>
            </div>
            
        </footer>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="reservas_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserva tu cita del día <span id = "diaSemana"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">  
                <button class="btn btn-success btn-block" id="btn_h1" data-dismiss="modal">08:00 - 10:00</button>
                <button class="btn btn-success btn-block" id="btn_h2" data-dismiss="modal">10:00 - 12:00</button>
                <button class="btn btn-success btn-block" id="btn_3" data-dismiss="modal">12:00 - 14:00</button>
            </div>
            <div class="col-md-6"> 
                <button class="btn btn-success btn-block" id="btn_h4" data-dismiss="modal">14:00 - 16:00</button>
                <button class="btn btn-success btn-block" id="btn_h5" data-dismiss="modal">16:00 - 18:00</button>
                <button class="btn btn-success btn-block" id="btn_h6" data-dismiss="modal">18:00 - 20:00</button>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#btn_h1').click(function(){
        $('#formulario_modal').modal("show");;
        $('#fecha_reserva').val(a);
        var h1 = "08:00 - 10:00";
        $('#hora_reserva').val(h1);
    });
</script>

<?php
    include("../html/cargarMascotas.php");
?>
<!-- Modal -->
<div class="modal fade" id="formulario_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserva tu cita del día <span id = "diaSemana"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Nombre de la mascota</label>
                    <select name="mascota" id="">
                        <?php foreach ($mascotasUsuario as $mascota) { ?>
                            <option value="<?php echo $mascota['nombreMascota']; ?>"><?php echo $mascota['nombreMascota']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Fecha de reserva</label>
                    <input type="text" class="form-control" id="fecha_reserva" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Hora de reserva</label>
                    <input type="text" class="form-control" id="hora_reserva" disabled>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>