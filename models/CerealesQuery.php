<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cereales]].
 *
 * @see Cereales
 */
class CerealesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cereales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cereales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
