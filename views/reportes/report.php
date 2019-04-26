<style>
    body {
        font-size: 13px;
        font-family: "Calibri Light";
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
    <strong><u>Movimientos de cereales - Acopio: <?= $mov[0]['nom_aco']; ?></u></strong>
</div>
<div class="row">
    <table>
        <thead>
        <tr>
            <th style="text-align: left; width: 10%;">Cód.</th>

            <th style="text-align: left; width: 10%;">Fecha</th>

            <th style="text-align: left; width: 20%;">Procedencia</th>

            <th style="text-align: left; width: 15%;">Entrados</th>
            <th style="text-align: left; width: 15%;">Salidos</th>

            <th style="text-align: left; width: 10%;">Saldo</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $stockAct = $mov[0]['stock'];
        foreach ($mov as $key => $m):
            if ($m['tip'] == 1):
                $stock = $stockAct + $m['can_mov'];
            else:
                $stock = $stockAct - $m['can_mov'];
            endif;
            ?>

            <tr>

                <td><?php echo ($m['tip'] == 1) ? 'I-' : 'V-';
                    echo str_pad($m['id_mov'], 4, 0, STR_PAD_LEFT); ?></td>
                <td><?php echo date('d/m/Y', strtotime($m['fec_cos'])); ?></td>
                <td><?php echo $m['nom_lug']; ?></td>
                <td style="text-align: center;"><?php echo ($m['can_mov'] && $m['tip'] == 1) ? number_format($m['can_mov'], 2, ',', '.') : '-'; ?></td>
                <td style="text-align: center;"><?php echo ($m['can_mov'] && $m['tip'] == 2) ? number_format($m['can_mov'], 2, ',', '.') : '-'; ?></td>
                <td><?php echo number_format($stock, 2, ',', '.'); ?></td>
                <!--<td><?php /*echo $m['nom_aco']; */
                ?></td>-->
            </tr>

        <?php

            $stockAct = $stock;
        endforeach; ?>
        </tbody>
    </table>
</div>