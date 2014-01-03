<?php 
require_once 'multiStepForm.php';

setCurrentStepIndex(2);

if (!checkCorrectStep()) {
	redirect(firstFormStep());
}
 ?>


<h3>Fine!!</h3>