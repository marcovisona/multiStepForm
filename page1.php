<?php 
require_once 'multiStepForm.php';

setFormSteps(array('page1.php','page2.php','page3.php'));
setCurrentStepIndex(0);

 ?>
<?php formOpen(); ?>
	<input type="text" name="page1text" value="" />
	<input type="submit" name="page1submit" value="Avanti" /> 
<?php formClose(); ?>