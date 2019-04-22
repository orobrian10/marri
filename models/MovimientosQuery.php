<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Movimientos]].
 *
 * @see Movimientos
 */
class MovimientosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Movimientos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Movimientos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
