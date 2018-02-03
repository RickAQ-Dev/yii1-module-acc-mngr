<?php 
	Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/form-custom.css');
?>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">

		<h2>Sign Up</h2>
		<hr />

		<div class="form">
				
			<?php 
				$form=$this->beginWidget('CActiveForm', array(
				    'id'=>'signup-form',
				    'htmlOptions' => array(
				        'class' => 'form-signup'
				    )
				)); 
			?>

			<div class="row">
				<div class="col-md-12">
					<?php echo $form->errorSummary(array($account,$user),null,null, array('class' => 'alert alert-danger')); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $form->label($account,'email_address'); ?>
						<?php echo $form->textField($account,'email_address', array('class' => 'form-control')); ?>
						<?php echo $form->error($account,'email_address'); ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $form->label($account,'newPassword'); ?>
						<?php echo $form->passwordField($account,'newPassword', array('class' => 'form-control')); ?>
						<?php echo $form->error($account,'newPassword'); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $form->label($account,'confirmPassword'); ?>
						<?php echo $form->passwordField($account,'confirmPassword', array('class' => 'form-control')); ?>
						<?php echo $form->error($account,'confirmPassword'); ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $form->label($user,'first_name'); ?>
						<?php echo $form->textField($user,'first_name', array('class' => 'form-control')); ?>
						<?php echo $form->error($user,'first_name'); ?>
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo $form->label($user,'last_name'); ?>
						<?php echo $form->textField($user,'last_name', array('class' => 'form-control')); ?>
						<?php echo $form->error($user,'last_name'); ?>
					</div>	
				</div>
			</div>

			<br />
			<br />
			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $form->checkbox($termAccount,'termsAndConditions'); ?>
					<?php echo $form->label($termAccount,'termsAndConditions'); ?>
					<?php echo $form->error($termAccount,'termsAndConditions'); ?>
				</div>
			</div>
			<br />

			<div class="row text-center">
				<div class="col-md-12">
					<?php echo CHtml::submitButton("Sign Up", array('class' => 'btn btn-lg btn-primary')); ?>
				</div>
			</div>


			<?php $this->endWidget(); ?>

		</div>

	</div>
	<div class="col-md-2"></div>
</div>