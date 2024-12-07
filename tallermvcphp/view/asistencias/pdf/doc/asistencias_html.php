<!-- Asistencias -->
<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left; width: 33%">Listado de Asistencias</td>
                <td style="text-align: center; width: 34%">DET WIFI</td>
                <td style="text-align: right; width: 33%"><?php echo date('d/m/Y'); ?></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left; width: 50%">Leng. Prog. III</td>
                <td style="text-align: right; width: 50%">página [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

    <br><br>

    <table style="width: 80%; border: solid 1px #5544DD; border-collapse: collapse; margin-left: auto; margin-right: auto;">
        <thead>
            <tr>
                <th style="width: 20%; text-align: left; border: solid 1px #900C3F; background: #900C3F; color: #FFFFFF;">
                    <span style="color: #FFFFFF;">USUARIO ID</span>
                </th>
                <th style="width: 20%; text-align: left; border: solid 1px #900C3F; background: #900C3F; color: #FFFFFF;">
                    <span style="color: #FFFFFF;">FECHA</span>
                </th>
                <th style="width: 20%; text-align: left; border: solid 1px #900C3F; background: #900C3F; color: #FFFFFF;">
                    <span style="color: #FFFFFF;">HORA ENTRADA</span>
                </th>
                <th style="width: 20%; text-align: left; border: solid 1px #900C3F; background: #900C3F; color: #FFFFFF;">
                    <span style="color: #FFFFFF;">HORA SALIDA</span>
                </th>
                <th style="width: 20%; text-align: left; border: solid 1px #900C3F; background: #900C3F; color: #FFFFFF;">
                    <span style="color: #FFFFFF;">COMENTARIOS</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($rows as $row) {
            ?>
                <tr>
                    <td style="width: 20%; text-align: left; border: solid 1px #900C3F">
                        <?= htmlspecialchars($row['usuario_id'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td style="width: 20%; text-align: left; border: solid 1px #900C3F">
                        <?= htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td style="width: 20%; text-align: left; border: solid 1px #900C3F">
                        <?= htmlspecialchars($row['hora_entrada'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td style="width: 20%; text-align: left; border: solid 1px #900C3F">
                        <?= htmlspecialchars($row['hora_salida'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                    <td style="width: 20%; text-align: left; border: solid 1px #900C3F">
                        <?= htmlspecialchars($row['comentarios'], ENT_QUOTES, 'UTF-8') ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</page>
