<?php

class AccAccountController extends Controller
{

    public $views = array();

    public function init() {

        parent::init();

        $this->views = array(
            'view_index' => 'application.yii1-module-acc-mngr.views.account.index',
            'view_signUp' => 'application.yii1-module-acc-mngr.views.account.signUp',
            'view_security' => 'application.yii1-module-acc-mngr.views.account.security'
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
                'actions'=>array('index','signUp'),
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
            /*array('deny',  // deny all users
                'users'=>array('*'),
            ),*/
        );
    }

    public function actionIndex()
    {
        $this->render($this->views['view_index']);
    }

    public function actionSignUp(){

        $this->pageTitle = 'Sign Up';

        $account = new Account;
        $termAccount = new Account;
        $user = new AccountUser;

        if(isset($_POST['Account']) && isset($_POST['AccountUser'])) {

            $account->attributes = $_POST['Account'];
            $termAccount->attributes = $_POST['Account'];
            $user->attributes = $_POST['AccountUser'];

            $termAccount->setScenario('agreeonterms');
            $account->setScenario('signup');
            $user->setScenario('signup');

            $valid = $user->validate();
            $valid = $account->validate() && $valid;
            $valid = $termAccount->validate() && $valid;

            if($valid) {

                if($account->save(false))  {
                    $user->account_id = $account->id;

                    if($user->save(false)) {

                        Yii::app()->user->setFlash('success', 'You have successfully registered. Please login using your username and password.');

                        $this->redirect(Yii::app()->user->loginUrl);

                    }
                }

            }

        }

        $this->render($this->views['view_signUp'], array(
            'account' => $account,
            'termAccount' => $termAccount,
            'user' => $user
        ));
    }

    public function actionSecurity(){

        $webUser = Yii::app()->user;
        $account = $webUser->account;

        $account->newPassword = $account->password;

        $this->render($this->views['view_security'], array(
            'account' => $account
        ));

    }

    public function actionUpdateEmailAddress() {

        if(isset($_POST['Account'])) {

            $webUser = Yii::app()->user;
            $account = $webUser->account;

            $account->setScenario('changeEmailAddress');

            $account->setAttributes($_POST['Account']);

            $valid = $account->validate();

            if($valid) {
                
                $account->changeEmailAddress();

                if($account->save(false)) {

                    Yii::app()->user->id = $account->email_address;
                    Yii::app()->user->name = $account->email_address;
                    Yii::app()->user->setFlash('email-address-success', "Email Address successfully updated.");
                }

            }

            if(!$valid) {
                $errorMessage = "<strong>Updating Email Address failed.</strong> <br /><br />";

                $errorMessage .= CHtml::errorSummary($account);

                Yii::app()->user->setFlash('email-address-error', $errorMessage);
            }

            $this->redirect(Yii::app()->user->returnUrl);

        }

    }

    public function actionChangePassword() {

        if(isset($_POST['Account'])) {

            $webUser = Yii::app()->user;
            $account = $webUser->account;

            $account->setScenario('changePassword');

            $account->setAttributes($_POST['Account']);

            $valid = $account->validate();

            if($valid) {

                $account->changePassword();

                if($account->save(false)) {
                    Yii::app()->user->setFlash('change-password-success', "Password successfully changed.");

                }
                else
                    $valid = false;

            }
            else 
                $valid = false;

            if(!$valid) {

                $errorMessage = "<strong>Changing Password failed.</strong> <br /><br />";
                $errorMessage .= CHtml::errorSummary($account);

                Yii::app()->user->setFlash('change-password-error', $errorMessage);

            }

            $this->redirect(Yii::app()->user->returnUrl);

        }

    }

    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
} 