<?php
require_once 'alumno.entidad.php';
require_once 'alumno.model.php';

// Logica
$alm = new Alumno();
$model = new AlumnoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$alm->__SET('id',              $_REQUEST['id']);
			$alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Apellido',        $_REQUEST['Apellido']);
			$alm->__SET('Sexo',            $_REQUEST['Sexo']);
			$alm->__SET('FechaNacimiento', $_REQUEST['FechaNacimiento']);

			$model->Actualizar($alm);
			header('Location: index.php');
			break;

		case 'registrar':
			$alm->__SET('Nombre',          $_REQUEST['Nombre']);
			$alm->__SET('Apellido',        $_REQUEST['Apellido']);
			$alm->__SET('Sexo',            $_REQUEST['Sexo']);
			$alm->__SET('FechaNacimiento', $_REQUEST['FechaNacimiento']);

			$model->Registrar($alm);
			header('Location: index.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['id']);
			header('Location: index.php');
			break;

		case 'editar':
			$alm = $model->Obtener($_REQUEST['id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PC COM CRUD</title>
    <!--ESTILOS CSS BOOTSTRAP-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    </head>
    <body>
        <div class="container">
            <div>
                <br>
                <h3 class="text-center">Gestionar Personas</h3>
            </div>
                <br>
                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" >
                    <input type="hidden" name="id" class="form-control" value="<?php echo $alm->__GET('id'); ?>" />
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="Nombre">Nombre</label> 
                            <input type="text" name="Nombre" class="form-control" autofocus required value="<?php echo $alm->__GET('Nombre'); ?>"  />
                        </div>
                            <div class="col-md-6">
                            <label for="Apellido">Apellido</label> 
                            <input type="text" name="Apellido" class="form-control" required value="<?php echo $alm->__GET('Apellido'); ?>" />
                        </div>
                     </div>
                     <div class="row">  
                        <div class="col-md-6">
                            <label for="Sexo">Sexo</label> 
                            <select name="Sexo" class="form-control" required>
                                    <option value="1" <?php echo $alm->__GET('Sexo') == 1 ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="2" <?php echo $alm->__GET('Sexo') == 2 ? 'selected' : ''; ?>>Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="Nombre">Fecha</label> 
                            <input type="date" name="FechaNacimiento" class="form-control" required value="<?php echo $alm->__GET('FechaNacimiento'); ?>" />
                        </div>
                     </div>
                     <div class="row"> 
                         <div class="col-md-12">
                             <br>
                             <button type="submit" class="btn btn-primary float-right" >Guardar</button>
                         </div>
                    </div>
                </form>
                <br>
                <table id="tablaPersona" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Sexo</th>
                            <th>Nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="datos">
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Apellido'); ?></td>
                            <td><?php echo $r->__GET('Sexo') == 1 ? 'H' : 'F'; ?></td>
                            <td><?php echo $r->__GET('FechaNacimiento'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>" class="btn btn-outline-info">Editar</a>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>     
                <br>
            </div>
    </body>

<!-- JAVASCRIPT -->
<script src="assets/js/all.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="js/persona.js"></script>
</html>





