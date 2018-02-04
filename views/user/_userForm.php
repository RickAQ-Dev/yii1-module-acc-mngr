<div class="row">
	<div class="col-md-12">
		<?php
	        foreach(Yii::app()->user->getFlashes() as $key => $message) {

	            $class = null;

	            if($key == 'error')
	                $class = "alert alert-danger";

	            if($key == 'success')
	                $class = "alert-success";

	        echo '<div class="col-md-12 flash-' . $key . ' alert '.$class.'">' . $message . "</div>\n";
	        }
	    ?>
	</div>
</div>

<div class="form">
	
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
		    'id'=>'user-form',
		    'action' => array('user/updateInformation'),
		    'method' => 'post',
		    'htmlOptions' => array(
		        'class' => 'form-user'
		    )
		)); 
	?>

	<div class="row">
		<div class="col-md-12">
			<?php echo $form->errorSummary($user); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $form->labelEx($user,'first_name'); ?>
				<?php echo $form->textField($user,'first_name', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'first_name'); ?>
			</div>			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $form->labelEx($user,'last_name'); ?>
				<?php echo $form->textField($user,'last_name', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'last_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<?php echo $form->labelEx($user,'street_no'); ?>
				<?php echo $form->textField($user,'street_no', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'street_no'); ?>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<?php echo $form->labelEx($user,'street'); ?>
				<?php echo $form->textField($user,'street', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'street'); ?>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<?php echo $form->labelEx($user,'city'); ?>
				<?php echo $form->textField($user,'city', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'city'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php echo $form->labelEx($user,'location'); ?>
				<?php echo $form->textField($user,'location', array('class' => 'form-control')); ?>
				<?php echo $form->error($user,'location'); ?>
			</div>			
		</div>
	</div>

	<br />
	<br />

	<div class="row">
		<div class="col-md-12 text-center">
			<?php echo CHtml::submitButton('Update Information', array('class' => 'btn btn-lg btn-primary')); ?>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div>