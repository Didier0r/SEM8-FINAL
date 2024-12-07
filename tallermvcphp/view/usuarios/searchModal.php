<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
    require_once(CONTROLLER_PATH.'usuarioController.php');
    $object = new usuarioController();
    $rows = $object->listUsuarios(); 
?>
<div class="table-responsive">
    <table id="tablaDetalles" class="table mb-0">
        <thead style="background-color: #002d72;">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
                <th scope="col" class="text-center" style="width: 36px;">Acción</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($rows as $row) {
                $idUsuario = $row['id'];
                $nombre = $row['nombre'];
                $email = $row['email'];
                $rol = $row["rol_id"];
        ?>
            <tr>
                <td><?=$idUsuario?></td>
                <td><?=$nombre?>
                    <input type="hidden" id="nombre_<?=$idUsuario?>" value="<?=$nombre?>">
                </td>
                <td><?=$email?>
                    <input type="hidden" id="email_<?=$idUsuario?>" value="<?=$email?>">
                </td>
                <td>
                    <div class="float-right">
                        <input type="text" class="form-control" style="text-align:right" id="rol_<?=$idUsuario?>" value="<?=$rol?>" readonly>
                    </div>
                </td>
                <td class='text-center'>
                    <a class='btn btn-success' href="#" onclick="agregarUsuario('<?=$idUsuario?>')"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div id="loader" style="position: absolute; text-align: center; top: 55px; width: 100%; display: none;"></div>
    <div id="outer_div"></div>
</div>
<script>
    $(document).ready( function () {
        var table = new DataTable('#tablaDetalles', {
            language: {
                url: '../../assets/js/es-ES.json',
            },
            'paging': true,
            lengthMenu: [
                [5, 10, 25, -1],
                [5, 10, 25, 'Todos']
            ],
            columnDefs: [
                {
                    orderable: false,
                    targets: [0,1,2,3,4]
                }
            ]
        });
    });

    // Función para manejar el clic en agregar
    function agregarUsuario(idUsuario) {
        const nombre = document.getElementById('nombre_' + idUsuario).value;
        const email = document.getElementById('email_' + idUsuario).value;
        const rol = document.getElementById('rol_' + idUsuario).value;

        alert(`Usuario seleccionado:\nID: ${idUsuario}\nNombre: ${nombre}\nEmail: ${email}\nRol: ${rol}`);
        // Aquí puedes agregar la lógica para manejar el usuario seleccionado
    }
</script>
