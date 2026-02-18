<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $main_photo
 *
 * @property Authors[] $authors
 * @property AuthorsBooks[] $authorsBooks
 */
class Books extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'main_photo'], 'default', 'value' => null],
            [['name', 'year', 'isbn'], 'required'],
            [['year'], 'integer'],
            [['description'], 'string'],
            [['name', 'main_photo'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 13],
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
            'year' => Yii::t('app', 'Year'),
            'description' => Yii::t('app', 'Description'),
            'isbn' => Yii::t('app', 'Isbn'),
            'main_photo' => Yii::t('app', 'Main Photo'),
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::class, ['id' => 'author_id'])->viaTable('authors_books', ['book_id' => 'id']);
    }

    /**
     * Gets query for [[AuthorsBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsBooks()
    {
        return $this->hasMany(AuthorsBooks::class, ['book_id' => 'id']);
    }

    public static function getTopYearAuthirs(int $year, int $limit = 10)
    {

        return self::find()
            ->select([
                'authors.id',
                'authors.name',
                'COUNT(books.id) OVER(partition by authors.id) AS books_count',
            ])
            ->where(['year' => $year])
            ->joinWith('authors')
            ->orderBy(['books_count' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

}
