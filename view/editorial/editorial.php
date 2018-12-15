<h1 class="page-header">Editorial</h1>
<div class="well well-sm text-right">
		<?php if ($_SESSION['users_tipos_id']!= 2 ) {
							# En este caso tendran acceso los que no sean estudiantes
		?>
	<a href="?c=Editorial&a=Crud" class="btn btn-primary">Nuevo Editorial</a>
			<?php
					}
			?>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<th style="width: 180px;">Nombre</th>
			<th style="width: 60px;"></th>
			<th style="width: 60px; "></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($alm as $r):
		?>
		
		<tr>
			<td><?php echo $r->nombre_editorial; ?></td>
			<td>
				<?php if ($_SESSION['users_tipos_id']!= 2 ) {
					# En este caso tendran acceso los que no sean estudiantes
				?>
				<a href="?c=Editorial&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
				<?php
					}
				?>
			</td>
			<td>
				<?php if ($_SESSION['users_tipos_id']!= 2 ) {
						# En este caso tendran acceso los que no sean estudiantes
				?>
				<a href="?c=Editorial&a=Eliminar&id=<?php echo $r->id; ?>" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');">Eliminar</a>
				<?php
					}
				?>		
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>