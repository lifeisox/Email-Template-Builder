<?php 
	require_once('./header.php'); 
	
	$template_id = filter_input( INPUT_GET, "template_id", FILTER_DEFAULT);
	$vfile =  "outputs/output" . $template_id . ".html";

?>
    <!-- Page Content ------------------------------------------------------------------>
    <div class="container">
	
        <!-- Projects Row -->
        <div class="row text-center">
		<div class="col-lg-12">
<?php
            echo "<iframe class='col-lg-12' src='" . $vfile . "' height='500px' style='border: none' ></iframe>";
?>
		</div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Buttons -->
        <div class="row text-center">
            <div class="col-lg-12">
<?php
                echo "<a class='btn btn-primary' style='width: 120px !important;' href='./builder.php?template_id=" . $template_id . "'><span class='glyphicon glyphicon-edit'></span> Modify</a>"; 
				echo "&nbsp; &nbsp;";
                echo "<a class='btn btn-danger' style='width: 120px !important;' data-toggle='modal' href='#deleteDialog'>
					<span class='glyphicon glyphicon-remove'></span> Delete</a>"; 
				echo "&nbsp; &nbsp;";
                echo "<a class='btn btn-success' style='width: 120px !important;' target='_blank' href='./download.php?template_id=" . $template_id . "'>
					<span class='glyphicon glyphicon-arrow-down'></span> Download</a>";
?>
            </div>
        </div>
	</div>
        <!-- /.row -->

	<!-- Modal ------------------------------------------------------------------------->
	<div class="modal fade" id="deleteDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header modal-header-danger">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4><strong>CONFIRMATION!</strong></h4>
				</div>
				<div class="modal-body">
					<h4>A Deleted message can't be recovered. <br/><br/>Do you really want to delete?</h4>
				</div>
				<div class="modal-footer">
<?php
					echo "<a class='btn btn-primary' style='width: 90px !important;' href='./delete.php?template_id=" . $template_id .
						"'><span class='glyphicon glyphicon-ok'></span>  Yes</a>";
?>
					<button type="button" class="btn btn-default" style="width: 90px !important;" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>  No</button>
				</div>
			</div> <!-- End of modal-content ------------------------------------------->
		</div> <!-- End of modal-dialog ------------------------------------------------>
	</div> <!-- End of Modal ----------------------------------------------------------->
	
<?php include './footer.php'; ?>