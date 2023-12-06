var a;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: new Date(),
        locale:'es',
        editable: true,
        selectable: true,
        headerToolbar: {
        left: '',
        center: 'title',
        right: 'prev,next'
        },
        events: '../html/cargarReservas.php',

        dateClick: function(info){
        a = info.dateStr;
        const fechaComoCadena = a;
        var numeroDia = new Date(fechaComoCadena).getDay();
        var dias = ['lunes','martes','miércoles','jueves','viernes','sábado']
        if(numeroDia == "6"){
            alert ("Domingos no disponibles!");
        }else{
            $('#reservas_modal').modal("show");
            $('#diaSemana').html(dias[numeroDia ] + " " + a) ;
            var fecha = info.dateStr;
            var res = "";
            var url = "../php/verificar_horario.php";
            $.get(url,{fecha:fecha},function(datos){
                res = datos;                
                $('#respuesta_horario').html(res);
            });
        }
        }
    });

    calendar.render();
    });

    
