<?php

namespace app\modules\ap\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $prod_id
 * @property string $title
 * @property string $price
 * @property double $weight
 *
 * @property Orders $order
 * @property Products $prod
 */
class OrderItems extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'prod_id', 'title', 'price', 'weight'], 'required'],
            [['order_id', 'prod_id'], 'integer'],
            [['price', 'weight'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['prod_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'ID заказа',
            'prod_id' => 'ID товара',
            'title' => 'Название',
            'price' => 'Цена (рублей)',
            'weight' => 'Вес (грамм)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Products::className(), ['id' => 'prod_id']);
    }
}
