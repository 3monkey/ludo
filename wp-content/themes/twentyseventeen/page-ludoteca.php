<?php get_header(); ?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
 

<style type="text/css">
  .btn-primary {
    padding: 10px;
    margin: 10px;
    border:  solid grey;
    border-radius: 10px;
    cursor: pointer;
    
  }

  .actions-table{
    margin:20px;

  }

  .btn-action {
    cursor: pointer;
    padding: 5px;
  }

  .btn_actions {
    width: auto;
  }

  #dialog-form {
    background-color: white;
    padding: 20px
    z-index: 50000 !important;
  }

  #dialog-form input.text { margin-bottom:12px; width:95%; padding: .4em; }
  
  #dialog-form select { margin-bottom:12px; width:95%; padding: .4em; }

  fieldset { padding:0; border:0; margin-top:25px; }
</style>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo get_site_url();?>/wp-includes/js/ludoteca.js"></script>
<div class="wrap">
    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th></th>
                  <th>Juego</th>
                  <th>Categoría</th>
                  <th>Nº Jugadores</th>
                  <th>Duracion</th>
                  <th>Autor</th>
                  <th>Editorial</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                </tr>
              </thead>
    </table>
    <div class="actions-table">
      <input type='file' ><span class='btn-primary'><i id="loadCsv" title='Upload ...' class="fas fa-upload fa-1x"></i></span></input>
      <span id="download" title="Download ..." class='btn-primary'>Download ... <i class="fas fa-download"></i></span>
      <span id="newLine" class='btn-primary'><i class="fas fa-plus"></i></span>
    </div>
</div>

<form id='dialog-form' name='form_game'>
  <fieldset>
    <label>Nombre</label><input name='i_game' id='i_game' class="text" value="" type="text"></input>
    <label>Categoría</label><select name='i_categoria' id='i_categoria'></select>
    <!--<span><i class="fa fa-plus"></i></span><input class="text" type="text" name="n_categoria" placeholder="categoria ..."/>-->
    <label>Nº Jugadores</label><input name='i_njugadores' id='i_njugadores' class="text" value="" type="text"></input>
    <label>Duración</label><input name='i_duracion' id='i_duracion' class="text" value="" type="text"></input>
    <label>Autor</label><select name='i_autor' id='i_autor'></select>
    <label>Editorial</label><select name='i_editorial' id='i_editorial'></select>
    <label>Activado</label><input name="i_anulado" id="i_anulado" type="checkbox"></input>
    <input type='hidden' value='' id="id_game" name='id_game'/>
    <input type='hidden' id='action' value='editLine' name='action'/>
  </fieldset>
</form>



<?php get_footer(); ?>