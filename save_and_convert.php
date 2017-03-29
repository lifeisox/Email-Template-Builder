<?php
	// Database connection and function defenition
	require_once('classes/templateDAO.php'); 
	require_once('classes/templateBodyDAO.php');

	/*
     * Create Header of HTML 
     */
	function createHeader($template, $fileWriteHandle){
		$sourcePath = realpath( './templates/' . $template->getBaseName() . '_header.txt' );

		$fileReadHandle = fopen($sourcePath, 'r'); // Open template file
		if ($fileReadHandle === false || $fileWriteHandle === false) { return false; }

		while ( !feof($fileReadHandle) ) {
			$line = fgets($fileReadHandle, 1024);
			// Replace tag to the word in database
			$line = str_replace('{{WIDTH}}', $template->getWidth(), $line);
			$line = str_replace('{{SUBJECT}}', $template->getEmailSubject(), $line);
			fputs($fileWriteHandle, $line);
		}

		fclose($fileReadHandle);
		return true;
    }
	
	/*
     * Create Body of HTML 
     */
	function createBody($template, $templateBody, $fileWriteHandle){
		$sourcePath = realpath( './templates/' . $template->getBaseName() . '_' . $templateBody->getBodyId() . '.txt' );

		$fileReadHandle = fopen($sourcePath, 'r'); // Open template file
		if ($fileReadHandle === false || $fileWriteHandle === false) { return false; }

		while ( !feof($fileReadHandle) ) {
			$line = fgets($fileReadHandle, 1024);
			// Replace tag to the word in database
			$line = str_replace('{{TEXT}}', $templateBody->getBodyText(), $line);
			$line = str_replace('{{IMAGE}}', $templateBody->getControlPath(), $line);
			$line = str_replace('{{LINK}}', $templateBody->getControlPath(), $line);
			fputs($fileWriteHandle, $line);
		}

		fclose($fileReadHandle);
		return true;
    }
	
	/*
     * Create Footer of HTML 
     */
    function createFooter($template, $fileWriteHandle){
		$sourcePath = realpath('./templates/' . $template->getBaseName() . '_footer.txt' );
		// when changing hosting, must be changed.
		
		$fileReadHandle = fopen($sourcePath, 'r'); // Open template file
		if ($fileReadHandle === false || $fileWriteHandle === false) { return false; }

		while ( !feof($fileReadHandle) ) {
			$line = fgets($fileReadHandle, 1024);
			// Replace tag to the word in database
			$line = str_replace('{{COMPANYNAME}}', $template->getCompanyName(), $line);
			$line = str_replace('{{PHONENO}}', $template->getCompanyPhone(), $line);
			if (!empty($template->getCompanyEmail())) {
				$line = str_replace('{{EMAIL}}', "<a href='mailto:" . $template->getCompanyEmail() . "' target='_blank'>" . $template->getCompanyEmail() . "</a>", $line);
			} else {
				$line = str_replace('{{EMAIL}}', '', $line);
			}
			$line = str_replace('{{ADDRESS}}', $template->getCompanyAddress(), $line);

			if (!empty($template->getCompanyFacebook())) {
				$line = str_replace('{{FACEBOOK}}', "<a href='" . $template->getCompanyFacebook() . 
					($template->getTemplateId() == 2 ? "' class='fa fa-facebook'>" : ("'><img src='" . $root . "images/facebook.png'>" )) . "</a>", $line);
			} else {
				$line = str_replace('{{FACEBOOK}}', '', $line);
			}
			
			if (!empty($template->getCompanyTwitter())) {
				$line = str_replace('{{TWITTER}}', "<a href='" . $template->getCompanyTwitter() . 
					($template->getTemplateId() == 2 ? "' class='fa fa-twitter'>" : ("'><img src='" . $root . "images/twitter.png'>" )) . "</a>", $line);
			} else {
				$line = str_replace('{{TWITTER}}', '', $line);
			}
			
			if (!empty($template->getCompanyGooglePlus())) {
				$line = str_replace('{{GOOGLEPLUS}}', "<a href='" . $template->getCompanyGooglePlus() . 
					($template->getTemplateId() == 2 ? "' class='fa fa-google-plus'>" : ("'><img src='" . $root . "images/google-plus.png'>" )) . "</a>", $line);
			} else {
				$line = str_replace('{{GOOGLEPLUS}}', '', $line);
			}
			
			if (!empty($template->getCompanyInstagram())) {
				$line = str_replace('{{INSTAGRAM}}', "<a href='" . $template->getCompanyInstagram() . 
					($template->getTemplateId() == 2 ? "' class='fa fa-instagram'>" : ("'><img src='" . $root . "images/instagram.png'>" )) . "</a>", $line);
			} else {
				$line = str_replace('{{INSTAGRAM}}', '', $line);
			}
			
			fputs($fileWriteHandle, $line);
		}

		fclose($fileReadHandle);
		return true;
    }


    $param = filter_input( INPUT_POST, "param", FILTER_DEFAULT);
	$template_id = filter_input( INPUT_POST, "templateId", FILTER_DEFAULT);
	$output = "./outputs/output" . $template_id . ".html";

	$templateDAO = new TemplateDAO();
	$templateBodyDAO = new TemplateBodyDAO();
	
    if ( $param === "header" ) {
        $templateName = filter_input( INPUT_POST, "templateName", FILTER_DEFAULT);
        $width = filter_input( INPUT_POST, "width", FILTER_DEFAULT);
        $subject = filter_input( INPUT_POST, "subject", FILTER_DEFAULT);

        $templateDAO->updateHeader($template_id, $templateName, $width, $subject);
	} else if ( $param === "footer" ) {
		$companyName = filter_input( INPUT_POST, "companyName", FILTER_DEFAULT);
		$companyPhone = filter_input( INPUT_POST, "companyPhone", FILTER_DEFAULT);
        $companyEmail = filter_input( INPUT_POST, "companyEmail", FILTER_DEFAULT);
        $companyAddress = filter_input( INPUT_POST, "companyAddress", FILTER_DEFAULT);
        $companyFacebook = filter_input( INPUT_POST, "companyFacebook", FILTER_DEFAULT);
		$companyTwitter = filter_input( INPUT_POST, "companyTwitter", FILTER_DEFAULT);
		$companyGooglePlus = filter_input( INPUT_POST, "companyGooglePlus", FILTER_DEFAULT);
		$companyInstagram = filter_input( INPUT_POST, "companyInstagram", FILTER_DEFAULT);

        $templateDAO->updateFooter($template_id, $companyName, $companyPhone, $companyEmail, $companyAddress, 
			$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram);
	} else {
		$contents = json_decode(filter_input( INPUT_POST, "jsonContents", FILTER_DEFAULT), true);
		$templateBodyDAO->delete( $template_id );

		if ( $contents ) {
			$size = count($contents);
			if ( $size > 0 ) {
				for ($i=0; $i < $size; $i++) {
					$templateBodyDAO->insert( $template_id, $i, $contents[$i][0], $contents[$i][1], $contents[$i][2] );
				}
			} 
		} 
	}

	// Read template table
	try {		
		$template = $templateDAO->getTemplate($template_id);
		$fileWriteHandle = fopen($output, 'w');
       	if($template){
			createHeader($template, $fileWriteHandle);
			// Read template body table
			$templateBodys = $templateBodyDAO->getTemplateBodys($template_id);
			if($templateBodys){
			    foreach($templateBodys as $templateBody) {
					createBody($template, $templateBody, $fileWriteHandle);
				}
            }
			createFooter($template, $fileWriteHandle);
        }
		fclose($fileWriteHandle);
		fflush($fileWriteHandle);
    } catch(Exception $ex) {
        echo '<h3>Error on page.</h3>';
        echo '<p>' . $ex->getMessage() . '</p>';            
    }

?>
