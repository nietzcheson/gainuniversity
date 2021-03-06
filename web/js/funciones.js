$(document).ready(function(){
  $( ".datepicker" ).datepicker();

  $('.dataTables').dataTable();

  $("#sortable").sortable();
  //$("#sortable").disableSelection();

  $('.delete').click(function(){

    event.preventDefault();
    var son = $(this).parent();
    var parent = son.parent();

    parent.remove();

  });

  var ordenesColeccion;

  $('.add').on('click', function(){

    ordenesColeccion = $('tbody.collections');

    ordenesColeccion.data('index', ordenesColeccion.find(':input').length);

    addOrdenForm(ordenesColeccion);
  });

  function addOrdenForm(ordenesColeccion){
    var prototype = ordenesColeccion.data('prototype');

    var index = ordenesColeccion.data('index');

    var nuevaOrden = prototype.replace(/__name__/g, index);

    ordenesColeccion.data('index', index + 1);

    $('tbody.collections').append(nuevaOrden);
    var nuevaOrdenTR = $('<tr></tr>').append(nuevaOrden);
  }
});
