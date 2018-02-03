<?php

class AccAccountController extends Controller
{

    public $views = array();

    public function init() {

        parent::init();

        $this->views = array(
            'view_index' => 'application.yii1-module-acc-mngr.views.account.index',
            'view_signUp' => 'application.yii1-module-acc-mngr.views.account.signUp'
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

            $valid = $account->validate();
            $valid = $user->validate() && $valid;
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