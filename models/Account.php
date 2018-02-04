<?php

/**
 * This is the model class for table "{{acc_account}}".
 *
 * The followings are the available columns in table '{{acc_account}}':
 * @property string $id
 * @property string $username
 * @property string $email_address
 * @property string $password
 * @property integer $salt
 * @property integer $active
 * @property string $date_created
 */
class Account extends CActiveRecord
{

	public $newPassword;
	public $confirmPassword;
	public $termsAndConditions;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{acc_account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email_address,', 'required', 'on' =>'signup, changeEmailAddress'),
			array('email_address', 'checkValidity', 'on' => 'signup, changeEmailAddress'),
			array('newPassword,confirmPassword', 'required', 'on' =>'signup, changePassword',),
			array('newPassword', 'length', 'min'=>8),
			array('newPassword','validateNewPassword', 'on' => 'signup, changePassword'),
			array('termsAndConditions', 'validateTerm', 'on' => 'agreeonterms'),
			array('salt, active', 'numerical', 'integerOnly'=>true),
			array('username, email_address', 'length', 'max'=>200),
			array('password', 'length', 'max'=>255),
			array('newPassword, confirmPassword,termsAndConditions', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email_address, password, salt, active, date_created', 'safe', 'on'=>'search'),
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
			'user' => array(self::HAS_ONE, 'AccountUser', 'account_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email_address' => 'Email Address',
			'password' => 'Password',
			'salt' => 'Salt',
			'active' => 'Active',
			'date_created' => 'Date Created',

			'newPassword' => 'Password',
			'confirmPassword' => 'Confirm Password',

			'termsAndConditions' => 'I Agree with the Terms & Conditions.',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt);
		$criteria->compare('active',$this->active);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {

		if(parent::beforeSave()) {

			if($this->isNewRecord) {

				// set the username attribute
				$this->username = $this->email_address;

				// set date created attribute
				$date = new DateTime('Now');
				$this->date_created = $date->format('Y-m-d H:i:s');

				// hash password
				$this->password = password_hash($this->newPassword, PASSWORD_BCRYPT);

			}

			return true;

		}

	}

	public function validateNewPassword($attribute) {


		if( !empty($this->confirmPassword) && $this->confirmPassword != $this->$attribute){
			$this->addError($attribute,'Password and Confirm Password are not the same.');
			return false;
		}

		return true;

	}

	public function checkValidity($attribute) {

		if(!empty($this->$attribute)) {

			if (!filter_var($this->$attribute, FILTER_VALIDATE_EMAIL)) {
				$this->addError($attribute, 'Invalid email address.');
				return false;
			}

			$res = $this->getAccountByEmailAddress($this->$attribute);

			if($res){
				$this->addError($attribute, "Email Address is already in use.");
				return false;
			}

		}

		return true;

	}

	public function validateTerm($attribute) {

		if(empty($this->$attribute)) {
			$this->addError($attribute, "Please check the box to agree to our terms and conditions.");
			return false;
		}

		return true;

	}

	public function getAccountByEmailAddress($emailAddress) {

		$model = Account::model()->find(array('condition' => 'email_address=:email_address', 'params' => array(':email_address' => $emailAddress)));

		return $model;

	}

	public function hashPassword($password) {

		return password_hash($password, PASSWORD_BCRYPT);

	}

	public function changePassword() {

		$hashPassword = $this->hashPassword($this->newPassword);

		$this->password = $hashPassword;

	}

	public function changeEmailAddress() {

		$this->username = $this->email_address;

	}
}
