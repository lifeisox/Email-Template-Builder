<?php
require_once('abstractDAO.php');
require_once('template.php');

class TemplateDAO extends AbstractDAO {
        
    function __construct() {
        try {
            parent::__construct();
        } catch(mysqli_sql_exception $e) {
            throw $e;
        }
    }
    
    /*
     * Returns an array of all template objects. If no template exist, returns false.
     */
    public function getTemplates() {
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT template_id, b.base_id, base_name, template_name, width,
			email_subject, company_name, company_phone, company_email, company_address,
			company_facebook, company_twitter, company_googleplus, company_instagram
			FROM template a, template_base b WHERE a.base_id = b.base_id ORDER BY template_id;');
        $templates = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new template object, and add it to the array.
                $template = new Template($row['template_id'], $row['template_name'], $row['base_id'], $row['base_name'], $row['width'], $row['email_subject'], $row['company_name'], 
				$row['company_phone'], $row['company_email'], $row['company_address'], $row['company_facebook'], $row['company_twitter'],
				$row['company_googleplus'], $row['company_instagram'] );
                $templates[] = $template;
            }
            $result->free();
            return $templates;
        }
        $result->free();
        return false;
    }
    
    /*
     * Returns an Template object. If no template exist, returns false.
     */
    public function getTemplate($templateID){
        $query = 'SELECT template_id, template_base.base_id, base_name, template_name, width,
			email_subject, company_name, company_phone, company_email, company_address,
			company_facebook, company_twitter, company_googleplus, company_instagram
			FROM template, template_base WHERE template_base.base_id = template.base_id AND template_id = ?';
		// The prepare method of the mysqli object returns a mysqli_stmt object.  
        // It takes a parameterized query as a parameter.
        $stmt = $this->mysqli->prepare($query);
		// The string contains a one-letter datatype description for each parameter. 'i' is used for integer.
        $stmt->bind_param('i', $templateID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $template = new Template($row['template_id'], $row['template_name'], $row['base_id'], $row['base_name'], $row['width'], $row['email_subject'], $row['company_name'], 
				$row['company_phone'], $row['company_email'], $row['company_address'], $row['company_facebook'], $row['company_twitter'],
				$row['company_googleplus'], $row['company_instagram'] );
            $result->free();
            return $template;
        }
        $result->free();
        return false;
    }

	/*
	 * Insert template record. if failed, return false else return template_id
	 */
    public function insertTemplate($baseId, $templateName, $width, $emailSubject, $companyName, $companyPhone, $companyEmail, $companyAddress,
		$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram){

        if(!$this->mysqli->connect_errno){
			
            $query = 'INSERT INTO template (base_id, template_name, width, email_subject, company_name, company_phone,
				company_email, company_address, company_facebook, company_twitter, company_googleplus, company_instagram) VALUES 
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

            // The prepare method of the mysqli object returns a mysqli_stmt object.  
            // It takes a parameterized query as a parameter.
            $stmt = $this->mysqli->prepare($query);
            // The first parameter of bind_param takes a string describing the data. 
			// In this case, we are passing six variables.
            $stmt->bind_param('isisssssssss', $baseId, $templateName, $width, $emailSubject, $companyName, $companyPhone, $companyEmail, $companyAddress,
				$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram);
            //Execute the statement
            $stmt->execute();
            //If there are errors, they will be in the error property of the mysqli_stmt object.
            if($stmt->error){
                return false;
            } else {
                return $stmt->insert_id;
            }
        } else {
            return false;
        }
    }

	/*
	 * Insert template record. if failed, return false else return template_id
	 */
    public function insert($baseId, $templateName){

        if(!$this->mysqli->connect_errno){
			
            $query = 'INSERT INTO template (base_id, template_name) VALUES (?, ?)';

            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('is', $baseId, $templateName);
            //Execute the statement
            $stmt->execute();
            //If there are errors, they will be in the error property of the mysqli_stmt object.
            if($stmt->error){
                return false;
            } else {
                return $stmt->insert_id;
            }
        } else {
            return false;
        }
    }
	
    /*
	 * Delete template record. if failed, return false else return true
	 */
    public function deleteTemplate($templateID) {
		
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM template WHERE template_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $templateID);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
	
    /*
	 * Update template record. if failed, return false else return true
	 */
    public function updateTemplate($baseId, $templateID, $templateName, $width, $emailSubject, $companyName, $companyPhone, $companyEmail, $companyAddress,
		$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram) {
			
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE template SET base_id = ?, template_name = ?, width = ?, email_subject = ?, company_name = ?, company_phone = ?,
				company_email = ?, company_address = ?, company_facebook = ?, company_twitter = ?, company_googleplus = ?, company_instagram = ? 
				WHERE template_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('isisssssssssi', $baseId, $templateName, $width, $emailSubject, $companyName, $companyPhone, $companyEmail, $companyAddress,
				$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram, $templateID);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
		
    /*
	 * Update template record. if failed, return false else return true
	 */
    public function updateHeader($templateID, $templateName, $width, $emailSubject) {
			
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE template SET template_name = ?, width = ?, email_subject = ? WHERE template_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('sisi', $templateName, $width, $emailSubject, $templateID);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
	}
		
    /*
	 * Update template record. if failed, return false else return true
	 */
    public function updateFooter($templateID, $companyName, $companyPhone, $companyEmail, $companyAddress, 
			$companyFacebook, $companyTwitter, $companyGooglePlus, $companyInstagram) {
			
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE template SET company_name = ?, company_phone = ?, company_email = ?, company_address = ?, 
				company_facebook = ?, company_twitter = ?, company_googleplus = ?, company_instagram = ? WHERE template_id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssssssssi', $companyName, $companyPhone, $companyEmail, $companyAddress, $companyFacebook, 
				$companyTwitter, $companyGooglePlus, $companyInstagram, $templateID);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
	}
}

?>
