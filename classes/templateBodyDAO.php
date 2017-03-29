<?php
require_once('abstractDAO.php');
require_once('templateBody.php');

class TemplateBodyDAO extends AbstractDAO {
        
    function __construct() {
        try {
            parent::__construct();
        } catch(mysqli_sql_exception $e) {
            throw $e;
        }
    }
    
    /*
     * Returns an array of all templateBody objects. If no template body records exist, returns false.
     */
    public function getAllTemplateBodys() {
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM template_body ORDER template_id, sequential_id;');
        $templates = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new template object, and add it to the array.
                $template = new TemplateBody($row['template_id'], $row['sequential_id'], $row['body_id'], $row['control_path'], $row['body_text'] );
                $templates[] = $template;
            }
            $result->free();
            return $templates;
        }
        $result->free();
        return false;
    }

	/*
     * Returns an array of all templateBody objects by templateId. If no template body records exist, returns false.
     */
    public function getTemplateBodys($templateID) {
        $query = 'SELECT * FROM template_body WHERE template_id = ? ORDER BY sequential_id;';
		// The prepare method of the mysqli object returns a mysqli_stmt object.  
        // It takes a parameterized query as a parameter.
        $stmt = $this->mysqli->prepare($query);
		// The string contains a one-letter datatype description for each parameter. 'i' is used for integer.
        $stmt->bind_param('i', $templateID);
        $stmt->execute();
        $result = $stmt->get_result();
        $templates = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new template object, and add it to the array.
                $template = new TemplateBody($row['template_id'], $row['sequential_id'], $row['body_id'], $row['control_path'], $row['body_text'] );
                $templates[] = $template;
            }
            $result->free();
            return $templates;
        }
        $result->free();
        return false;
    }
	
    /*
     * Returns an TemplateBody object. If no template body record exist, returns false.
     */
    public function getTemplateBody($templateID, $sequentialID){
        $query = 'SELECT * FROM template_body WHERE template_id = ? AND sequential_id = ?';
		// The prepare method of the mysqli object returns a mysqli_stmt object.  
        // It takes a parameterized query as a parameter.
        $stmt = $this->mysqli->prepare($query);
		// The string contains a one-letter datatype description for each parameter. 'i' is used for integer.
        $stmt->bind_param('ii', $templateID, $sequentialID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $template = new TemplateBody($row['template_id'], $row['sequential_id'], $row['body_id'], $row['control_path'], $row['body_text'] );
            $result->free();
            return $template;
        }
        $result->free();
        return false;
    }

	/*
	 * Insert template body record. if failed, return false else return true
	 */
    public function insert( $templateID, $sequentialID, $bodyID, $controlPath, $bodyText ){

        if(!$this->mysqli->connect_errno){
			
            $query = 'INSERT INTO template_body (template_id, sequential_id, body_id, control_path, body_text) VALUES (?, ?, ?, ?, ?)';

            // The prepare method of the mysqli object returns a mysqli_stmt object.  
            // It takes a parameterized query as a parameter.
            $stmt = $this->mysqli->prepare($query);
            // The first parameter of bind_param takes a string describing the data. 
			// In this case, we are passing six variables.
            $stmt->bind_param('iiiss', $templateID, $sequentialID, $bodyID, $controlPath, $bodyText);
            //Execute the statement
            $stmt->execute();
            //If there are errors, they will be in the error property of the mysqli_stmt object.
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
	 * Delete template body record. if failed, return false else return true
	 */
    public function delete($templateID) {
		
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM template_body WHERE template_id = ?';
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
	 * Update template body record. if failed, return false else return true
	 */
    public function updateTemplateBody($templateID, $sequentialID, $bodyID, $controlPath, $bodyText) {
			
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE template_body SET body_id = ?, control_path = ?, body_text = ? 
				WHERE template_id = ? AND sequential_id';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('issii', $bodyID, $controlPath, $bodyText, $templateID, $sequentialID);
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
