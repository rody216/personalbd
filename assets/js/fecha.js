
// Inicializar el selector de fecha
$(document).ready(function() {
    $('#fecha_de_nacimiento').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
});

$(function() {
    $('#datetimepicker1').datetimepicker({
      format: 'DD/MM/YYYY HH:mm',
      autoclose: true,
      todayHighlight: true
    });
  });


