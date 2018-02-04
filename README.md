# yii1-module-acc-mngr
This project aims to provide developers ready available models, controllers and views for account management.

# How to setup

## Step 1 : Download the module project
Download the module project [here](https://github.com/RickAQ-Dev/yii1-module-acc-mngr).

## Step 2 : Extraction
Extract the .zip folder inside the **/protected** directory of your yii project.

The folder should contain the following folders:
* components
 * views
* controllers
* models
* views
  * account
  * profile
  * user

## Step 3 : Import Classes
Import the classes in the project directory into your yii project configuration.

From :
```

'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.commonClass.*'
	),

```

To:
```
'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.commonClass.*',
    // new added classes
		'application.[extracted module folder].models.*',
		'application.[extracted module folder].controllers.*',
	)
 ```

## Step 4 : Done!
You have successfully added the module classes into your yii1 project.

# How to Use / Usage

### Controllers
You can user the project controllers by extending the classes into your project classes.
Ex.

If you have **FooController.php** in your yii project **protected/controllers**. And you want to use the **AccAccountController.php**. 

Update your **FooController.php** file and change **extends Controller** to **extends AccAccountController**.

From:
```
 <?php
     class FooController extends Controller

```


To:
```
 <?php
     class FooController extends AccAccountController

```
