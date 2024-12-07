<div class="modal fade" id="idver<?=$row['id']?>" tabindex="-1" aria-labelledby="VistaModal<?=$row['id']?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VistaModal<?=$row['id']?>">Vista Completa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">USUARIO ID: <?=$row['usuario_id']?></li>
                    <li class="list-group-item">FECHA: <?=$row['fecha']?></li>
                    <li class="list-group-item">HORA DE ENTRADA: <?=$row['hora_entrada']?></li>
                    <li class="list-group-item">HORA DE SALIDA: <?=$row['hora_salida']?></li>
                    <li class="list-group-item">COMENTARIOS: <?=$row['comentarios']?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
