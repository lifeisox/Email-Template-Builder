<?php 
	// Database connection and function defenition
	require_once('classes/templateDAO.php'); 
	require_once('classes/templateBodyDAO.php');
	
	// get the file request, throw error if nothing supplied
	if(!isset($_REQUEST['template_id']) || empty($_REQUEST['template_id'])) {
		header("HTTP/1.0 400 Bad Request");
		exit;
	}

	$template_id = $_REQUEST['template_id'];

	// Read template table
	try {	
		$templateBodyDAO = new TemplateBodyDAO();
		if ($templateBodyDAO->delete( $template_id )== false) {
			echo "Error delete body";
		}
		$templateDAO = new TemplateDAO();
		if ($templateDAO->deleteTemplate( $template_id ) == false) {
			echo "Error delete template";
		}
		header("Location: ./list.php"); 
		exit;
    } catch(Exception $ex) {
        echo '<h3>Error on page.</h3>';
        echo '<p>' . $ex->getMessage() . '</p>';  
		exit;
    }
	

?>