<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Acopios]].
 *
 * @see Acopios
 */
class AcopiosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Acopios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Acopios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
