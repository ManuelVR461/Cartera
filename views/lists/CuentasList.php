<div class="table-responsive">
<caption>Lista de Cuentas</caption>
<table class="table table-sm" border="1">
    <thead>
        <tr>
            <td></td>
            <td>Nro</td>
            <td>Nombre</td>
            <td>Saldo</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($datos as $key => $cuenta) {
        ?>
        <tr>
            <td></td>
            <td><?php echo $cuenta['id']; ?></td>
            <td><?php echo $cuenta['descripcion']; ?></td>
            <td><?php echo $cuenta['saldo_inicial']." ".$cuenta['signo_moneda']; ?></td>
            <td>
                <button class="btn btn-success btn-list" name="btn-list" data-action="Cuentas/getCuenta" type="button">C</button>
                <button class="btn btn-danger btn-list" name="btn-list" data-action="Cuentas/delCuenta" type="button">X</button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>