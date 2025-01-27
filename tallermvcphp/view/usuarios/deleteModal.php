<div class="modal fade" id="iddel<?=$row['id']?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">¿Desea eliminar este usuario?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Una vez eliminado, no se podrá recuperar el usuario.</p>
        <ul>
          <li><strong>ID:</strong> <?= htmlspecialchars($row['id']) ?></li>
          <li><strong>Nombre:</strong> <?= htmlspecialchars($row['nombre']) ?></li>
          <li><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a href="delete.php?id=<?= $row['id'] ?>" type="button" class="btn btn-danger">Eliminar</a>
      </div>
    </div>
  </div>
</div>
