<?php 
/* @var $this Controller*/
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/yii1-module-acc-mngr/profile.css');
Yii::app()->clientScript->registerScriptFile("https://unpkg.com/feather-icons/dist/feather.min.js");
?>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h2><?php echo $user->getCompleteName(); ?></h2>
			<div class="view-profile">
				<div class="text-center">
					<i class="profile-img" data-feather="user"></i>	
				</div>
				<section class="profile-info">
					<h4>Information</h4>
					<div class="separator"></div>
					<div class="row form-group">
						<div class="col-md-6">
							<label>Firstname</label><br />
							<strong><?php echo $user->first_name; ?></strong>
						</div>
						<div class="col-md-6">
							<label>Lastname</label><br />
							<strong><?php echo $user->last_name; ?></strong>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label>Email Address</label><br />
							<strong><?php echo $account->email_address; ?></strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Home Address</label> <br />
							<strong>
								<?php 

									$homeAddress = $user->street_no.' '.$user->street;

									echo ((!empty(trim($homeAddress)))? $homeAddress : "<i class='light-color'>not set</i>");
								?>
							</strong>
						</div>
						<div class="col-md-6">
							<label>City</label> <br />
							<strong>
								<?php 

									echo ((!empty(trim($user->city)))? $user->city : "<i class='light-color'>not set</i>");
								?>
							</strong>
						</div>
						<div class="col-md-6">
							<label>Location</label> <br />
							<strong>
								<?php 

									echo ((!empty(trim($user->location)))? $user->location : "<i class='light-color'>not set</i>");
								?>
							</strong>
						</div>
					</div>
				</section>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<?php
Yii::app()->clientScript->registerScript('featherjs', "

	feather.replace();

");
?>