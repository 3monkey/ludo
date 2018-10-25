jQuery(document).ready(function($) {

  //$('#checkLine').hide();
  //$('#cancelLine').hide();

  var dataSet = [];
  var games = [];
  var categorias = [];
  var autores = [];
  var editoriales = [];

  var dialog;
  var i_game = $('#i_game');
  var id_game = $('#id_game');
  var i_categoria = $('#i_categoria');
  var i_njugadores = $('#i_njugadores');
  var i_duracion = $('#i_duracion');
  var i_autor = $('#i_autor');
  var i_editorial = $('#i_editorial');
  var i_anulado = $('#i_anulado');
  var gameSelect;

  var dataTable = $('#dataTable').DataTable({
    columns:[
      { 
        render: function( data, type, row){
          return "<span id='btn-edit' attr='"+row.game_id+"'><i class='fas fa-edit'></i></span>";
        }
      },
      { data: "titulo" },
      { data: "categoria" },
      { data: "n_jugadores" },
      { data: "duracion" },
      { data: "autor" },
      { data: "editorial" },
      { data: "user_nicename" },
      { 
        render: function( data, type, row){
          if(row.anulado == 1){
            return "<span><i class='fas fa-times'></i></span>";
          }else{
            return "<span><i class='fas fa-check'></i></span>";
          }
        }
      },
    ]
  });

  dialog = $('#dialog-form').dialog({
      autoOpen: false,
      height: 700,
      width: 500,
      modal: true,
      buttons: {
        Editar: function(){
          if($('#action').val() != 'newLine'){
            $('#action').val('editLine');
          }
          setData($('#dialog-form'));
          dialog.dialog( "close" );
        },
        Anular: function() {
          if(confirm("¿Realmente quieres eliminar el registro?")){
            if($('#action').val() == 'newLine'){
              alert('No puedes eliminar un juego que aún no has creado.');
            }else{
              $('#action').val('deleteLine');
              setData($('#dialog-form'));
              dialog.dialog( "close" );
            }
          }
        }
      }
    });

  $('#dataTable').on('click','#btn-edit',function(e){
      e.preventDefault();
      var value = $(this).attr('attr');
      var gameSelect = $.map(games,function(row){
        return (row.game_id == value) ? row: null;
      });

      if(gameSelect.length > 0){
        $('#action').val('editLine')
        i_game.val(gameSelect[0].titulo);
        i_njugadores.val(gameSelect[0].n_jugadores);
        i_duracion.val(gameSelect[0].duracion);
        id_game.val(gameSelect[0].game_id);

        i_categoria.children("option[value='"+gameSelect[0].categoria_id+"']").attr('selected',true);
        i_autor.children("option[value='"+gameSelect[0].autor_id+"']").attr('selected',true);
        i_editorial.children("option[value='"+gameSelect[0].editorial_id+"']").attr('selected',true);
        dialog.dialog('open');
      }else{
        alert('No se ha seleccionado un registro.');
      }
  });

  $('#loadCsv').on('click',function(e){
    e.preventDefault();

    // Comprobar si se ha seleccionado un archivo.
  });

  $('#download').on('click',function(e){
    e.preventDefault();

    
  });

  $('#newLine').on('click',function(e){
    e.preventDefault();

    i_game.val('');
    i_njugadores.val('');
    i_duracion.val('');
    id_game.val('');
    $('#action').val('newLine');

    dialog.dialog('open');
  });

  function init(){
    $.ajax({
        //url : dcms_vars.ajaxurl,
        url : '/wp-admin/admin-ludo.php',
        type: 'post',
        data: {
          action : 'init',
        },
        beforeSend: function(){
        },
        success: function(response){
          var data = JSON.parse(response);
          games = data.data.games;
          categorias = data.data.categorias;
          autores = data.data.autores;
          editoriales = data.data.editoriales;

          initCombos();
          refreshTable(dataTable, data.data.games);
        },
        error: function(error){
          if(error){
            alert(error);
          }
        }

      }); 
  }


  function setData(data){
    return $.ajax({
        url : '/wp-admin/admin-ludo.php',
        type: 'post',
        data: data.serialize(),
        beforeSend: function(){
        },
        success: function(response){
          if(response.error){
            alert(response.message);
          }

          var data = JSON.parse(response);
          games = data.data.games;

          refreshTable(dataTable, data.data.games);
        },
        error: function(error){
          alert(error)
        }

      });
  }

  function refreshTable(dataTable,dataSet){
    dataTable.clear();
    dataTable.rows.add(dataSet).draw();
  }

  function initCombos(){
    $.each(categorias, function(key, value){
      $('#i_categoria').append("<option value='" + value.categoria_id + "'>" + value.categoria + "</option>");
    });
    $.each(autores, function(key, value){
      $('#i_autor').append("<option value='" + value.autor_id + "'>" + value.autor + "</option>");
    });
    $.each(editoriales, function(key, value){
      $('#i_editorial').append("<option value='" + value.editorial_id + "'>" + value.editorial + "</option>");
    });
  }    

  init();
});