<div class="modal fade" id="idver<?=$row['id']?>" tabindex="-1" aria-labelledby="VistaModal<?=$row['id']?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="VistaModal<?=$row['id']?>">Vista Completa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card" style="width: 28rem;">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ID PERMISO: <?=$row['id']?></li>
            <li class="list-group-item">FECHA DE INICIO: <?=$row['fecha_inicio']?></li>
            <li class="list-group-item">FECHA DE FIN: <?=$row['fecha_fin']?></li>
            <li class="list-group-item">USUARIO: <?=$row['usuario_id']?></li>
            <li class="list-group-item">TIPO DE PERMISO: <?=$row['tipo']?></li>
            <li class="list-group-item">ESTADO: <?=$row['estado']?></li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
