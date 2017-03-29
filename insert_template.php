<?php
	// Database connection and function defenition
	require_once('classes/templateDAO.php'); 
	require_once('classes/templateBodyDAO.php');

    $baseId = filter_input( INPUT_GET, "baseId", FILTER_DEFAULT);
	$templateName = filter_input( INPUT_GET, "templateName", FILTER_DEFAULT);

	$templateDAO = new TemplateDAO();
	$templateId = $templateDAO->insert($baseId, $templateName);

	header("Location: ./converter.php?template_id=" . $templateId);
?>
