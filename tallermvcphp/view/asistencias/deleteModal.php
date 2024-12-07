<div class="modal fade" id="iddel<?=$row['usuario_id']?>" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">¿Desea eliminar el registro de asistencia?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Una vez eliminado no se podrá recuperar el registro.</p>
            <p><strong>Usuario ID:</strong> <?= htmlspecialchars($row['usuario_id'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Hora Entrada:</strong> <?= htmlspecialchars($row['hora_entrada'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Hora Salida:</strong> <?= htmlspecialchars($row['hora_salida'], ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Comentarios:</strong> <?= htmlspecialchars($row['comentarios'], ENT_QUOTES, 'UTF-8') ?></p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!-- Formulario de eliminación -->
            <form action="delete.php" method="POST">
               <input type="hidden" name="id" value="<?= $row['usuario_id'] ?>">
               <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
         </div>
      </div>
   </div>
</div>
