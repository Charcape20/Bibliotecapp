<h1 class="page-header">Autores</h1>

<div class="well well-sm text-right">
    <?php if ($_SESSION['users_tipos_id']!= 2 ) {
        # En este caso tendran acceso los que no sean estudiantes
    ?>
    <a class="btn btn-primary" href="?c=Autor&a=Crud">Nuevo Autor</a>
    <?php
            }
    ?>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th style="width:120px;">Sexo</th>
            <th style="width:120px;">Estado</th>
            <th style="width:60px;"></th>
            <th style="width:60px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->Nombres; ?></td>
            <td><?php echo $r->ApellidoPaterno; ?></td>
            <td><?php echo $r->Email; ?></td>
            <td><?php echo $r->sexo_id == 1 ? 'Hombre' : 'Mujer'; ?></td>
            <td><?php echo $r->estado_id == 1 ? 'ACTIVO' : 'INACTIVO'; ?></td>
            <td>
            <?php if ($_SESSION['users_tipos_id']!= 2 ) {
              # En este caso tendran acceso los que no sean estudiantes
            ?>
                <a href="?c=Autor&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" 
                   href="?c=Autor&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            <?php
            }
           ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
