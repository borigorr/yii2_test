<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname
 * @property string|null $lastname
 *
 * @property AuthorsBooks[] $authorsBooks
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'lastname'], 'default', 'value' => null],
            [['name'], 'required'],
            [['name', 'surname', 'lastname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'lastname' => Yii::t('app', 'Lastname'),
        ];
    }

    /**
     * Gets query for [[AuthorsBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsBooks()
    {
        return $this->hasMany(AuthorsBooks::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['id' => 'book_id'])->viaTable('authors_books', ['author_id' => 'id']);
    }

}
