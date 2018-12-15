<h1 class="page-header">
    <?php echo $libro->id != null ? $libro->nombre_libro : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Libro">Libro</a></li>
  <li class="active"><?php echo $libro->id != null ? $libro->nombre_libro : 'Nuevo Libro'; ?></li>
</ol>

<form id="frm-autor" action="?c=Libro&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $libro->id; ?>" />
    
    <div class="row form-group">
        <div class="col-xs-12 col-sm-6">
            <label>Titulo Libro</label>
            <input type="text" class="form-control text-center" name="libro_nombre" value="<?php echo $libro->nombre_libro;?>"  placeholder="Nombre del Libro" required />
        </div>
        <div class="col-xs-12 col-sm-6">
            <label>Editorial</label>
            <select class="form-control" name="editorial_id">
            
            <?php foreach ($editoriales as $editorial)  :?> 
                <option 
                    <?php echo $libro->editorial_id == $editorial->id ? 'selected' : ''; ?> 
                        value = <?php echo $editorial->id ?>>
                        <?php echo $editorial->nombre_editorial ?>
                </option>    
            <?php endforeach; ?>
        </select>
        </div>
    </div>
                
    <div class="row form-group">
        <div class="col-xs-12 col-sm-6">
                <label>Estado</label>
                <select class="form-control" name="estado_id">
                
                <?php foreach ($estados as $estado)  :?> 
                    <option 
                        <?php echo $libro->estado_id == $estado->id ? 'selected' : ''; ?> 
                            value = <?php echo $estado->id ?>>
                            <?php echo $estado->nombre_estado ?>
                    </option>    
                <?php endforeach; ?>
            </select>
        </div>  
        <div class="col-xs-12 col-sm-6">
                <label>Genero</label>
                <select class="form-control" name="genero_id">
                
                <?php foreach ($generos as $genero)  :?> 
                    <option 
                        <?php echo $libro->genero_id == $genero->id ? 'selected' : ''; ?> 
                            value = <?php echo $genero->id ?>>
                            <?php echo $genero->nombre_genero ?>
                    </option>    
                <?php endforeach; ?>
            </select>
        </div>       
    </div>         

    <div class="row form-group">
        <div class="col-xs-12 col-sm-3">
            <label># de páginas</label>
            <input type="number" class="form-control text-center" name="numero_paginas" value="<?php echo $libro->numero_paginas;?>"  placeholder="Ingrese el # de pagonas" required />
        </div>   
        <div class="col-xs-12 col-sm-3">
            <label>Año de Edición</label>
            <input type="number" class="form-control text-center" name="anio_edicion" value="<?php echo $libro->anio_edicion;?>"  placeholder="Ingrese el año de Edición" required />
        </div>   
        <div class="col-xs-12 col-sm-3">
            <label>Fecha de Publicación</label>
            <input type="date" class="form-control text-center" name="FechaPublicacion" value="<?php echo $libro->FechaPublicacion;?>"  placeholder="Ingrese la Fecha de Publicación" required />
        </div>   

        <div class="col-xs-12 col-sm-3">
            <label>ISBN</label>
            <input type="text" class="form-control text-center" name="codigo_isbn" value="<?php echo $libro->codigo_isbn;?>"  placeholder="Ingrese el codigo ISBN" required />
        </div>   
    </div>        
    <br>
    <div class="row form-group">
      <div class="col-xs-12">
        <label>Resumen</label>
              <textarea type="text" class="form-control text-left" name="resumen" rows="10" placeholder="Ingrese un resumen" required><?php echo $libro->resumen;?></textarea>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-xs-12">
        <label>Imagen</label>
            <input type="checkbox" name="bimagenReferencia" selected>
      </div>
    </div>
                  
                  <div class="col-xs-12">
                    <label for="Imagen">Imagen</label>
                    
                    <input type="file" style="display: inline;" id="RutaImagenReferencia" name="RutaImagenReferencia"
                      accept=".jpg, .jpeg, .png">
                  </div>
                </div>

                <div class="form-group">
                  <fieldset>
                    <legend><h4>Autor o Autores en el Libro</h4></legend>
                    <div class="row">
                      <div class="col-xs-12 col-sm-2">
                        <button type="button" class="btnAgregarAutor btn btn-success pull-left">
                          <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Agregar</button>
                      </div>  
                      <div class="col-xs-12 col-sm-6">
                          <select id="autor_id" class="form-control">
                            <?php foreach ($autores as $autor)  :?> 
                              <option value = <?php echo $autor->id ?>>
                                      <?php echo $autor->Nombres . " " . $autor->ApellidoPaterno . " " . $autor->ApellidoMaterno ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                      </div>
                    </div>  
    
    
</form>