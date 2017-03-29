<?php 
	require_once('./header.php'); 
	// Database connection and function defenition
	require_once('classes/templateDAO.php'); 
	
	// the index of template list top
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
		if ( $page < 0 ) $page = 0;
	} else $page = 0;

	$PAGE_SIZE = 8; // How many items a Page has.
	$ROW_SIZE = 4; // How many columns a Row has.

	// Read template table
	try {		
		$templateDAO = new TemplateDAO();
		$templates = $templateDAO->getTemplates();
       	if(!$templates) {
			echo "<script>alert('There are no data to display on screen!');
				window.location.href = './index.php';</script>";
		}
    } catch(Exception $ex) {
		echo "<script>alert('Database connection or read error!');
				window.location.href = './index.php';</script>";
    }
?>


<?php
	function displayRow( $template ) {
		echo "<div class='col-lg-3  text-center'>";
        echo "    <a href='./converter.php?template_id=" . $template->getTemplateId() . "'>";
        echo "        <img class='img-responsive img-rounded' style='border: 1px solid black;' src='./images/thumb" . $template->getBaseId() . 
			".jpg' alt='" . $template->getBaseName() . " Template'>";
        echo "    </a>";
		echo "<h3>" . $template->getTemplateName() . "</h3>";
		echo "<a class='btn btn-primary' href='./converter.php?template_id=" . $template->getTemplateId() . "'>Preview & Download</a>";
        echo "</div>";
	}
?>

    <!-- Page Content ------------------------------------------------------------------>
    <div class="container">
<?php	
	$idx = 0;
	if ( ($page * $PAGE_SIZE + $idx) < count($templates) ) {
		echo "<div class='row'>";
		for ( ; $idx < $ROW_SIZE && ($page * $PAGE_SIZE + $idx) < count($templates); $idx++) {
			$template = $templates[$idx + $page * $PAGE_SIZE];
			displayRow( $template );
		}
		echo "</div>";
	}

	if ( ($page * $PAGE_SIZE + $idx) < count($templates) ) {
		echo "<div class='row' style='margin-top: 30px'>";
		for ( ; $idx < $ROW_SIZE * 2 && ($page * $PAGE_SIZE + $idx) < count($templates); $idx++) {
			$template = $templates[$idx + $page * $PAGE_SIZE];
			displayRow( $template );
		}
		echo "</div>";
	}
	
?>
	</div>
		<hr>
        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li><a href="#">&laquo;</a></li>
<?php
	$max = sprintf( '%d', (count($templates)-1) / $PAGE_SIZE + 1 );
	for ( $idx=0; $idx < $max; $idx++ ) {
		if ( $page == $idx ) {
			echo "<li class='active'><a href='#'>" . ($idx+1) . "</a></li>";
		} else {
			echo "<li><a href='./list.php?page=" . $idx . "'>" . ($idx+1) . "</a></li>";
		}
	}
?>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>

        <!-- /.row -->

<?php include './footer.php'; ?>