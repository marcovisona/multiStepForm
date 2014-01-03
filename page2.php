<?php 
require_once 'multiStepForm.php';

setCurrentStepIndex(1);

if (!checkCorrectStep()) {
	redirect(firstFormStep());
}

 ?>

<?php formOpen(); ?>
	<input type="text" name="page1text" value="" />
	<input type="submit" name="page1submit" value="Avanti" /> 
<?php formClose(); ?>
 