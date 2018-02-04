<div class="container">
	<h3>Security</h3>
	<div class="separator"></div>

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
			<div class="section">
				<h4>Change Email Address</h4>

				<div class="row">
					<div class="col-md-12">
						<?php

							$changeEmailError = Yii::app()->user->getFlash('email-address-error');
							$changeEmailSuccess = Yii::app()->user->getFlash('email-address-success');

							if($changeEmailError)
								echo '<div class="col-md-12 alert alert-danger">' . $changeEmailError . "</div>\n";

							if($changeEmailSuccess)
								echo '<div class="col-md-12 alert alert-success">' . $changeEmailSuccess . "</div>\n";
					    ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<?php 
							$form=$this->beginWidget('CActiveForm', array(
							    'id'=>'change-email-address-form',
							    'action' => array('account/updateEmailAddress'),
							    'method' => 'post',
							    'htmlOptions' => array(
							        'class' => 'form-signup'
							    )
							)); 
							$account->setScenario('changeEmailAddress');
						?>
							<div class="form-group">
								<?php echo CHtml::activeLabelEx($account,'email_address'); ?>
								<?php echo CHtml::activeTextField($account,'email_address', array('class' => 'form-control')); ?>
								<?php echo CHtml::error($account,'email_address'); ?>
							</div>

							<div class="text-right">
								<?php echo CHtml::submitButton('Change Email Address', array('class' => 'btn btn-sm btn-primary')); ?>
							</div>

						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>

			<div class="section">
				<h4>Change Password</h4>

				<div class="row">
					<div class="col-md-12">
						<?php

							$changePasswordError = Yii::app()->user->getFlash('change-password-error');
							$changePasswordSuccess = Yii::app()->user->getFlash('change-password-success');

					        if($changePasswordError)
								echo '<div class="col-md-12 alert alert-danger">' . $changePasswordError . "</div>\n";

							if($changePasswordSuccess)
								echo '<div class="col-md-12 alert alert-success">' . $changePasswordSuccess . "</div>\n";
					    ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<?php 
							$form=$this->beginWidget('CActiveForm', array(
							    'id'=>'change-password-form',
							    'action' => array('account/changePassword'),
							    'method' => 'post',
							    'htmlOptions' => array(
							        'class' => 'form-signup'
							    )
							)); 
							$account->setScenario('changePassword');
						?>
							<div class="form-group">
								<?php echo CHtml::activeLabelEx($account,'newPassword'); ?>
								<?php echo CHtml::activePasswordField($account,'newPassword', array('class' => 'form-control')); ?>
								<?php echo CHtml::error($account,'newPassword'); ?>
							</div>
							<div class="form-group">
								<?php echo CHtml::activeLabelEx($account,'confirmPassword'); ?>
								<?php echo CHtml::activePasswordField($account,'confirmPassword', array('class' => 'form-control')); ?>
								<?php echo CHtml::error($account,'confirmPassword'); ?>
							</div>

							<div class="text-right">
								<?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn-sm btn-primary')); ?>
							</div>

						<?php $this->endWidget(); ?>
						<br />
						<br />
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-2"></div>
	</div>

</div>