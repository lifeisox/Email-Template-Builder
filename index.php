<?php require_once('./header.php'); ?>

    <!-- Page Content ------------------------------------------------------------------>
    <div class="container">
	
        <!-- Projects Row -->
        <div class="row">
		<div class="col-lg-12">
            <div class="col-lg-3">
                <img class="img-responsive" src="./images/template1.jpg" alt="Standard Template">
            </div>
			<div class="col-lg-3">
				<h3>Standard Template</h3>
                <h6>HTML5, CS3</h6>
                <p>The Template provides simple and advanced email campaign functionality. You can create everything from bulk email to multi-stage nurture email campaigns.</p>
				<p>Email builder offers a visual nurture campaign builder to create automated campaigns. You can trigger communications based on specific prospect attributes or activities, as well as drip messages over a predefined fields.</p>
				<button id='insert-btn' type="button" class="btn btn-warning" onclick="insertDialog(1);">
								Get Start <i class="glyphicon glyphicon-chevron-right"></i></button>
			</div>
            <div class="col-lg-3">
                <img class="img-responsive" src="./images/template2.jpg" alt="Bootstrap Template">
            </div>
			<div class="col-lg-3">
				<h3>Bootstrap Template</h3>
                <h6>Bootstrap framework</h6>
                <p>The Template provides simple and advanced email campaign functionality. You can create everything from bulk email to multi-stage nurture email campaigns.</p>
				<p>Email builder offers a visual nurture campaign builder to create automated campaigns. You can trigger communications based on specific prospect attributes or activities, as well as drip messages over a predefined fields.</p>
                <button id='insert-btn' type="button" class="btn btn-primary" onclick="insertDialog(2);">
								Get Start <i class="glyphicon glyphicon-chevron-right"></i></button>
			</div>
		</div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <!-- /.row -->
	</div>	
		
		
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
	
	<script type="text/javascript">
		function insertDialog( param ) {
			var inName;
			
			BootstrapDialog.show({
				title: 'Enter New Template',
				message: 'Template Name: <input type="text" class="form-control">',
				onshown: function( dialogRef ) {
					inName = dialogRef.getModalBody().find('input');
					inName.focus();
				},

				buttons: [{
					label: 'Cancel',
					icon: 'glyphicon glyphicon-remove', 
					action: function( dialogRef ) {
						dialogRef.close();
					}
				}, {
					label: 'Create',
					icon: 'glyphicon glyphicon-ok',       
					cssClass: 'btn-primary', 
					action: function( dialogRef ) {
						window.location.href = "./insert_template.php?baseId=" + param + "&templateName=" + inName.val();
					}
				}]
			});
		}

    </script>	
<?php include './footer.php'; ?>