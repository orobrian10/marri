<style>
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
        Fecha desde: <?php echo date('d/m/Y',strtotime($fde)); ?>
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        Fecha hasta: <?php echo date('d/m/Y',strtotime($fha)); ?>
    </div>
</div>
<div class="row">
    <div style="width: 33.33%; text-align: center;float:left">
        Domicilio: -
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        Teléfono: -
    </div>
    <div style="width: 33.33%; text-align: center;float:left">
        C.U.I.T: -
    </div>
</div>
<div class="row" style="text-align: center">
    <hr>
    <strong><u>Movimientos</u></strong>
</div>
<div class="row">
    <table>
        <thead>
        <tr>
            <th style="text-align: left">Tipo</th>
            <th style="text-align: left">Cód. Mov.</th>

            <th style="text-align: left">Fecha</th>

            <th style="text-align: left">Entrados</th>
            <th style="text-align: left">Salidos</th>

            <th style="text-align: left">Orígen</th>
            <th style="text-align: left">Destino</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mov as $m):
            $entrados = '';
            $salidos = '';
            if ($m['tor_mov'] == 1):
                $nom_ori = \app\models\Campos::findOne(['id', $m['ori_mov']])->nom_campos;
            else:
                $nom_ori = \app\models\Acopios::findOne(['id_aco', $m['ori_mov']])->nom_aco;
            endif;

            if ($m['tde_mov'] == 1):
                $des_ori = \app\models\Campos::findOne(['id', $m['des_mov']])->nom_campos;
            else:
                $des_ori = \app\models\Acopios::findOne(['id_aco', $m['des_mov']])->nom_aco;
            endif;
            ?>
            <tr>
                <td>
                    <?php
                    if ($m['tip_mov'] == '1'):
                        echo 'Ingresos';
                    elseif ($m['tip_mov'] == '2'):
                        echo 'Retiros';
                    else:
                        echo 'Traslados';
                    endif;
                    ?>
                </td>
                <td><?php echo $m['cod_mov']; ?></td>

                <?php if ($m['tip_mov'] == 1):
                    $entrados = $m['can_mov'];
                else:
                    $salidos = $m['can_mov'];
                endif; ?>
                <td><?php echo date('d/m/Y',strtotime($m['fec_cos'])); ?></td>
                <td><?php echo ($entrados) ? number_format($entrados, 2,',','.') : '-'; ?></td>
                <td><?php echo ($salidos) ? number_format($salidos, 2,',','.') : '-'; ?></td>
                <td><?php echo $nom_ori; ?></td>
                <td><?php echo $des_ori; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>