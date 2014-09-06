<?php

/**
 * This is the model class for table "{{task}}".
 *
 * The followings are the available columns in table '{{task}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $frequency
 * @property integer $execution_mark
 * @property integer $destination_id
 *
 * The followings are the available model relations:
 * @property Destination $destination
 */
class Task extends CActiveRecord
{
	const NOT_EXECUTE = 0;
	const EXECUTE = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{task}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('title', 'length', 'max'=>128),
			array('description', 'length', 'max'=>256),
			array('frequency, execution_mark', 'numerical', 'integerOnly'=>true),
			array('frequency', 'in', 'range'=>array(1,2,3,4,5,6,7)),
			array('execution_mark', 'in', 'range'=>array(0,1)),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('title, description, frequency, execution_mark', 'safe', 'on'=>'search'),
			array('destination_id', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'destination' => array(self::BELONGS_TO, 'Destination', 'destination_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'title' => 'Название',
			'description' => 'Описание',
			'frequency' => 'Частота выполнения',
			'execution_mark' => 'Выполнено?',
			'destination_id' => 'Отнести к',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('execution_mark',$this->execution_mark);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
