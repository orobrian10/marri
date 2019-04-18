<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AcopiosLugares]].
 *
 * @see AcopiosLugares
 */
class AcopiosLugaresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcopiosLugares[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcopiosLugares|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
