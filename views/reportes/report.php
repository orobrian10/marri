<style>
    body {
        font-size: 13px;
        font-family: "sans-serif";
    }

    .row {
        width: 100%;
        margin-bottom: 5px;
    }

    table {
        width: 100%;
    }

</style>
<div class="row">
    <div style="width: 33.33%; text-align: center;float:left">
        <strong>MAQUIRRIAIN S.A.</strong>
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        Fecha desde: <?php echo date('d/m/Y', strtotime($fde)); ?>
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        Fecha hasta: <?php echo date('d/m/Y', strtotime($fha)); ?>
    </div>
</div>
<!--<div class="row">
    <div style="width: 33.33%; text-align: center;float:left">
        Domicilio: -
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        Teléfono: -
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        C.U.I.T: -
    </div>
</div>-->
<div class="row" style="text-align: center">
    <hr>
    <strong>Movimientos de cereales - Acopio: <?= $mov[0]['nom_aco']; ?> - Saldo inicial: <?= $mov[0]['stock']  ?></strong>
</div>
<div class="row">
    <table>
        <thead>
        <tr>

            <th style="text-align: left; width: 8%;">Fecha</th>

            <th style="text-align: left; width: 15%;">Procedencia</th>

            <th style="text-align: left; width: 13%;">Entrados</th>
            <th style="text-align: left; width: 10%;">N° Porte</th>

            <th style="text-align: left; width: 13%;">Salidos</th>

            <th style="text-align: left; width: 10%;">Saldo</th>
            <th style="text-align: left; width: 8%;">Observación</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $stockAct = $mov[0]['stock'];
        $totEnt = 0;
        $totSal = 0;
        foreach ($mov as $key => $m):
            if ($m['tip'] == 1):
                $totEnt += $m['can_mov'];
                $stock = $stockAct + $m['can_mov'];
            else:
                $totSal += $m['can_mov'];
                $stock = $stockAct - $m['can_mov'];
            endif;
            ?>

            <tr>
                <td><?php echo date('d/m/Y', strtotime($m['fec_cos'])); ?></td>
                <td><?php echo $m['nom_loc']; ?></td>
                <td style="text-align: center;"><?php echo ($m['can_mov'] && $m['tip'] == 1) ? number_format($m['can_mov'], 2, ',', '.') : '-'; ?></td>
                <td><?php echo $m['car_mov']; ?></td>
                <td style="text-align: center;"><?php echo ($m['can_mov'] && $m['tip'] == 2) ? number_format($m['can_mov'], 2, ',', '.') : '-'; ?></td>
                <td><?php echo number_format($stock, 2, ',', '.'); ?></td>
                <td><?php echo $m['obs_ven'] ?></td>
            </tr>

            <?php

            $stockAct = $stock;
        endforeach; ?>

        </tbody>
        <tfoot>
        <tr>
            <th style="text-align: left;" colspan="2">Totales</th>
            <th style="text-align: center;"><?php echo number_format($totEnt, 2, ',', '.'); ?></th>
            <th></th>
            <th style="text-align: center;"><?php echo number_format($totSal, 2, ',', '.'); ?></th>
            <th style="text-align: left;"><?php echo number_format(($totEnt-$totSal)+$mov[0]['stock'], 2, ',', '.'); ?></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</div>