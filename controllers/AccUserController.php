<?php

class AccUserController extends Controller {

	public $views = array();
	
	public function init() {

        parent::init();

        $this->views = array(
            'view_information' => 'application.yii1-module-acc-mngr.views.user.information',
            'view_user_form' => 'application.yii1-module-acc-mngr.views.user._userForm',
        );

    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
   /* public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }*/

     public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('information','updateInformation'),
                'users'=>array('*'),
            ),
           /* array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),*/
           /* array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),*/
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionInformation() {

    	$webUser = Yii::app()->user;
    	$account = $webUser->account;
    	$user = $account->user;

    	$user->setScenario('updateInfo');

    	Yii::app()->user->returnUrl = array('user/information');

    	$this->render($this->views['view_information'], array(
    		'user' => $user,
    		'userForm' => $this->views['view_user_form']
    	));

    }

    public function actionUpdateInformation() {

    	if(isset($_POST['AccountUser'])) {

    		$webUser = Yii::app()->user;

    		$account = $webUser->account;
    		$user = $account->user;

    		$user->setScenario('updateInfo');

    		$user->attributes = $_POST['AccountUser'];

    		$valid = $user->validate();

    		if($valid) {
    			if($user->save(false)) {

    				Yii::app()->user->setFlash('success', "Information successfully updated.");

    			}
    			else
    				$valid = false;
    		}
    		
    		if(!$valid){

    			$errorMessage = "<strong>Updating information failed.</strong>";

    			$errorMessage = $errorMessage."<br /><br />".CHtml::errorSummary($user);

				Yii::app()->user->setFlash('error',$errorMessage);
    		}

    		$this->redirect(Yii::app()->user->returnUrl);

    	}

    }

}