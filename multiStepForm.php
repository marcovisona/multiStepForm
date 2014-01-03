<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

define('MULTI_STEP_FORM', 'multiStepForm');
define('STEPS', 'steps');


function boolToString($bool)
{
	return $bool ? "true" : "false";
}

function dump($obj)
{
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}


function firstFormStep()
{
	if(!isset($_SESSION[MULTI_STEP_FORM][STEPS])){
		return "/";
	}
	return $_SESSION[MULTI_STEP_FORM][STEPS][0];
}

function nextStepIndex()
{
	return currentStepIndex() + 1;
}

function nextStep()
{
	$nextI = nextStepIndex();
	if (isset($_SESSION[MULTI_STEP_FORM][STEPS]) && $nextI < count($_SESSION[MULTI_STEP_FORM][STEPS])) {
		return $_SESSION[MULTI_STEP_FORM][STEPS][$nextI];
	}else{
		return "";
	}
}

function previousStepIndex()
{
	return currentStepIndex() - 1;
}

function previousStep()
{
	$prevI = previousStepIndex();
	if(isset($_SESSION[MULTI_STEP_FORM][STEPS]) && $prevI >= 0){
		return $_SESSION[MULTI_STEP_FORM][STEPS][$prevI];
	}else{
		return "";
	}
}

function setCurrentStepIndex($StepIndex)
{
	$_SESSION[MULTI_STEP_FORM]['currentStep'] = $StepIndex;
}

function currentStepIndex()
{
	return $_SESSION[MULTI_STEP_FORM]['currentStep'];
}

function setFormSteps($steps)
{
	echo MULTI_STEP_FORM;
	$_SESSION[MULTI_STEP_FORM] = array();
	$_SESSION[MULTI_STEP_FORM][STEPS] = $steps;
}

function checkCorrectStep()
{
	// se le variabili di sessione non sono inizializzate la pagina non è corretta
	if(!isset($_SESSION[MULTI_STEP_FORM][STEPS])){
		return false;
	}

	// se sono la prima pagina del form nessun problema
	$ex = explode("/", $_SERVER['PHP_SELF']);
	$me = $ex[count($ex) - 1];
	if ($me == firstFormStep()) {
		return true;
	}
	
	$referer = "";
	if(isset($_SERVER['HTTP_REFERER'])){
		$ex = explode("/", $_SERVER['HTTP_REFERER']);
		$ex = explode("?", $ex[count($ex) - 1]);
		$referer = $ex[0];
	}
	
	if ($referer == previousStep()) {
		return true;
	}

	return false;
}

function redirect($to)
{
	header("location: $to");
	exit();
}

function formOpen($destination="", $method = "POST", $htmlAttrs = ""){
	if ($destination == "") {
		$destination = nextStep();
	}
?>
	<form action="<?php echo $destination; ?>" method="<?php echo $method; ?>" <?php echo $htmlAttrs; ?> >
<?php
}

function formClose()
{
?>
	</form>
<?php
}

 ?>