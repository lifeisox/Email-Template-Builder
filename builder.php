<?php 
	require_once('./header.php');
	// Database connection and function defenition
	require_once('classes/templateDAO.php'); 
	require_once('classes/templateBodyDAO.php');	
	$root = filter_input( INPUT_SERVER, "DOCUMENT_ROOT", FILTER_DEFAULT);
	
	$template_id = filter_input( INPUT_GET, "template_id", FILTER_DEFAULT);

	if ( empty($template_id) ) {
		die( "Program is stopped because of error! Template ID:" . $template_id );
	}
	
	$output = "outputs/output" . $template_id . ".html";
	// Read template table
	
	$templateDAO = new TemplateDAO();
	$template = $templateDAO->getTemplate($template_id);
	if($template){
		$templateBodyDAO = new TemplateBodyDAO();
		$templateBodys = $templateBodyDAO->getTemplateBodys($template_id);
	}

	function AddBody( $index, $bodyType, $bodyText, $ctrlPath ) {
		echo "<div id='bodyItem".$index."' class='body_item col-md-12' style='padding: 5px 0px 5px 0px;'>";
		echo "	<div class='col-md-8'>";
		echo "		<input type='text' id='bodyId".$index."' value='".$bodyType."' hidden>";
		echo "		<div class='input-group'>";
		$bodyTextId = "bodyText".$index;
		$ctrlPathId = "ctrlPath".$index;
		switch ( $bodyType ) {
			case 0:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' style='font-weight: bold;' readonly value='".$bodyText."' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				break;
			case 1:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' readonly value='".$bodyText."' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				break;
			case 2:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
				echo "	<input type='text' class='form-control' id='".$ctrlPathId."' readonly value='".$ctrlPath. "' >";
				echo "	<input type='text' id='".$bodyTextId."' value='".$bodyText."' hidden >";
				break;
			case 3:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' readonly value='".$bodyText. "' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
				break;
			case 4:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' readonly value='".$bodyText. "' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
				break;
			case 5:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-saved'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' readonly value='".$bodyText. "' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				break;
			default:
				echo "	<div class='input-group-addon'><i class='glyphicon glyphicon-minus'></i></div>";
				echo "	<input type='text' class='form-control' id='".$bodyTextId."' readonly value='Spacer' >";
				echo "	<input type='text' id='".$ctrlPathId."' value='".$ctrlPath."' hidden >";
				break;
		}
		echo "		</div>";
		echo "	</div>";
		echo "	<div class='col-md-4 text-right'>";
		echo "		<button type='button' class='btn btn-success btn-xs' onclick='editRow(" . $index . ");'><i class='glyphicon glyphicon-eye-open'></i></button>";
		echo "		<div class='btn-group' role='group' aria-label='...'>";
		echo "			<button type='button' class='btn btn-default btn-xs' onclick='moveUp(" . $index . ");'><i class='glyphicon glyphicon-chevron-up'></i></button>";
		echo "			<button type='button' class='btn btn-default btn-xs' onclick='moveDown(" . $index . ");'><i class='glyphicon glyphicon-chevron-down'></i></button>";
		echo "		</div>";
		echo "		<button type='button' class='btn btn-danger btn-xs' onclick='deleteRow(" . $index . ");'><i class='glyphicon glyphicon-remove'></i></button>";
		echo "	</div>";
		echo "</div>";
	}
?>
    <!-- Page Content ------------------------------------------------------------------>
    <div class="container col-md-12">
		<div class="container col-md-4">
			<!-- Header ------------------------------------------------------------->
			<div class='container col-md-12' style="margin: 10px 0px 20px 0px;">
				<div class="panel panel-default">
					<!-- the panel for saving Header ---------------------------->
					<div id="panel-save-header-heading" class="panel-heading"">
						<div class="panel-title col-md-6"><h4>Header</h4></div>
						<div class='text-right'>
							<button id='header-save-btn' type="button" class="btn btn-primary btn-sm" onclick="saveMain('header');" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving...">
								<i class="glyphicon glyphicon-ok"></i> Save</button>
						</div>
					</div>
					<div id="panel-save-header-body" class="panel-body">
						<!-- Data Entry Form for Header ------------------------->
						<form name="headerUpdateForm" id="headerUpdateForm" data-toggle="validator" role="form" method="post" >
							<!-- Template Name ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inTemplateName">Template Name</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
									<input type="text" class="form-control" name="inTemplateName" id="inTemplateName" placeholder="Template Name" 
										   value='<?php echo $template->getTemplateName(); ?>' maxlength="30" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Width ------------------------------------>
							<div class="form-group">
								<label class="control-label" for="inWidth">Width</label>
								<div class="input-group col-md-6">
									<div class="input-group-addon"><i class="glyphicon glyphicon-text-width"></i></div>
									<input type="number" class="form-control" name="inWidth" id="inWidth" min="400" max="800" placeholder="Template Width" 
										   value='<?php echo $template->getWidth(); ?>' required>
								</div>
								<div class="help-block with-errors">Minimum 400 Maximum 800</div>
							</div>
							<!-- Subject ---------------------------------->
							<div class="form-group">
								<label class="control-label" for="inSubject">Email Subject</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
									<input type="text" class="form-control" name="inSubject" id="inSubject" placeholder="Email Subject" 
										   value='<?php echo $template->getEmailSubject(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</form> <!-- End of Data Entry Form for Main -->
					</div>
					<div class="panel-footer"></div>
				</div>
			</div> <!-- End of Header -->
			<!-- Body ------------------------------------------------------------->
			<div class='container col-md-12' style="margin: 10px 0px 20px 0px;">
				<div class="panel panel-default">
					<!-- the panel for saving Header ---------------------------->
					<div id="panel-save-body-heading" class="panel-heading"">
						<div class="panel-title col-md-6"><h4>Body</h4></div>
						<div class='text-right'>
							<button id='body-save-btn' type="button" class="btn btn-primary btn-sm" onclick="saveMain('body');" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving...">
								<i class="glyphicon glyphicon-ok"></i> Save</button>
						</div>
					</div>
					<div id="panel-save-body-body" class="panel-body">
<?php
				if ($templateBodys) {
					$index = 0;
					foreach ( $templateBodys as $tBody ) {
						addBody( $index, $tBody->getBodyId(), $tBody->getBodyText(), $tBody->getControlPath() );
						$index += 1;
					}   
				}
?>
					</div>
					
					<div class="panel-footer">
						<button id='addBtn' type='button' class='btn btn-danger' style='margin-left: 12px;' onclick='addRow();'><i class='glyphicon glyphicon-plus'></i> Add a Body Item</button>
					</div>
				</div>
			</div> <!-- End of Body -->
			<!-- Footer ------------------------------------------------------------->
			<div class='container col-md-12' style="margin: 10px 0px 20px 0px;">
				<div class="panel panel-default">
					<!-- the panel for saving Footer ---------------------------->
					<div id="panel-save-footer-heading" class="panel-heading"">
						<div class="panel-title col-md-6"><h4>Footer</h4></div>
						<div class='text-right'>
							<button id='footer-save-btn' type="button" class="btn btn-primary btn-sm" onclick="saveMain('footer');" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving...">
								<i class="glyphicon glyphicon-ok"></i> Save</button>
						</div>
					</div>
					<div id="panel-save-footer-body" class="panel-body">
						<!-- Data Entry Form for Body ------------------------->
						<form name="footerUpdateForm" id="footerUpdateForm" data-toggle="validator" role="form" method="post" >
							<!-- Company Name ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyName">Company Name</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="glyphicon glyphicon-home"></i></div>
									<input type="text" class="form-control" name="inCompanyName" id="inCompanyName" placeholder="Company Name" 
										   value='<?php echo $template->getCompanyName(); ?>' maxlength="40" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Phone ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyPhone">Company Phone</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></div>
									<input type="tel" class="form-control" name="inCompanyPhone" id="inCompanyPhone" 
										pattern="^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$" placeholder="613-100-1004"  data-error="Please keep format: 613-100-1004"
										   value='<?php echo $template->getCompanyPhone(); ?>' maxlength="20" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Email ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyEmail">Company Email</label>
								<div class="input-group">
									<div class="input-group-addon">@</div>
									<input type="email" class="form-control" name="inCompanyEmail" id="inCompanyEmail" placeholder="Company Email" 
										   value='<?php echo $template->getCompanyEmail(); ?>' maxlength="50" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Address ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyAddress">Company Address</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
									<input type="text" class="form-control" name="inCompanyAddress" id="inCompanyAddress" placeholder="Company Address" 
										   value='<?php echo $template->getCompanyAddress(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Facebook ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyFacebook">Company Facebook</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-facebook"></i></div>
									<input type="url" class="form-control" name="inCompanyFacebook" id="inCompanyFacebook" placeholder="Company Facebook" 
										   value='<?php echo $template->getCompanyFacebook(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Twitter ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyTwitter">Company Twitter</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-twitter"></i></div>
									<input type="url" class="form-control" name="inCompanyTwitter" id="inCompanyTwitter" placeholder="Company Twitter" 
										   value='<?php echo $template->getCompanyTwitter(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company GooglePlus ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyGooglePlus">Company GooglePlus</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-google-plus"></i></div>
									<input type="url" class="form-control" name="inCompanyGooglePlus" id="inCompanyGooglePlus" placeholder="Company GooglePlus" 
										   value='<?php echo $template->getCompanyGooglePlus(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
							<!-- Company Instagram ----------------------------------->
							<div class="form-group">
								<label class="control-label" for="inCompanyInstagram">Company Instagram</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-instagram"></i></div>
									<input type="url" class="form-control" name="inCompanyInstagram" id="inCompanyInstagram" placeholder="Company Instagram" 
										   value='<?php echo $template->getCompanyInstagram(); ?>' maxlength="100" required>
								</div>
								<div class="help-block with-errors"></div>
							</div>
						</form> <!-- End of Data Entry Form for Footer -->
					</div>
					<div class="panel-footer"></div>
				</div>
			</div> <!-- End of Footer -->
		</div>
		<div class="container col-md-8">
			<div class='col-md-12' style='padding-bottom: 10px; margin-bottom:30px; border-bottom: 2px solid graytext;'>
            <h3>Template Name: <span id='dispTemplateName' style="color: blue;"><?php echo $template->getTemplateName(); ?></span></h3>
        </div>
<?php
			echo "<iframe id='dispOutput' class='col-md-12' src='" . $output . "' frameborder='0' height='1200px' style='border: none;' ></iframe>";
?>
		</div>
	</div>
	
<!-- Modal for edit record ------------------------------------------------------->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding: 12px 20px 12px 25px; border-bottom:1px solid #eee; background-color: #9933ff; color: #f5deb3;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="editModalLabel">Edit Body</h4>
				</div>
				<div class="modal-body">
					<form>
						<div id="divMessage" class="form-group" style="color: #9542f4; font-weight: bold;"></div>
						<input type="text" id="mBodyId" value="" hidden>
						<input type="text" id="mIdx" value="" hidden>
						<div id="divBodyText" class="form-group">
							<label for="mBodyText" class="control-label">Text or Button Label:</label>
							<div class="input-group">
								<textarea class="form-control" id="mBodyText" name="mBodyText" rows="5" cols="100" placeholder="Text or Button Label" required ></textarea>
							</div>
							<div class="help-block with-errors"></div>
						</div>

						<div id="divCtrlPath" class="form-group">
							<label for="mCtrlPath" class="control-label">Image or Button Link Path:</label>
							<div class="input-group">
								<input type="url" class="form-control" name="mCtrlPath" id="mCtrlPath" placeholder="Image or Link URL" 
									value="" maxlength="100" required>
								<div class="input-group-btn"><label class="btn btn-primary" for="fileSelector">
									<input id="fileSelector" type="file" style="display:none;" accept=".gif,.jpg,.jpeg,.png" onchange="fileSelected();">
									Upload Image File</label>
								</div>
							</div>
							<div class="help-block with-errors"></div>
							<div class="progress" hidden>
								<div id="divProgress" class="progress-bar" role="progressbar" style="width: 100%"></div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer" style="background-color: white;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="update();" >Update</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal for add a record ------------------------------------------------------->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding: 12px 20px 12px 25px; border-bottom:1px solid #eee; background-color: #9933ff; color: #f5deb3;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addModalLabel">Add a Body</h4>
				</div>
				<div class="modal-body">
					<form>
						<!-- Body Type ------------------------------->
						<div class="form-group">
							<label for="mBodyType" class="control-label">Body Type</label>
							<div class="input-group btn-group" data-toggle="buttons">
								<label class="btn btn-default active">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="0" checked > Bold Text Only 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="1" > Plain Text Only 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="2" > Image Only 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="3" > Image(L) + Text(R) 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="4" > Text(L) + Image(R) 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="5" > Button 
								</label>
								<label class="btn btn-default">
									<input type="radio" name="mBodyType" id="mBodyType" autocomplete="off"  value="6" > Spacer 
								</label>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer" style="background-color: white;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="kkk" type="button" class="btn btn-primary" onclick="addUpdate();" >Add new body</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">

		function moveUp( idx ) {
			var content = $("#bodyItem"+idx);
			content.insertBefore(content.prev());
		}
		
		function moveDown( idx ) {
			var content = $("#bodyItem"+idx);
			content.next().insertBefore(content);
		}

		function deleteRow( idx ) {
			$("#bodyItem"+idx).remove();
		}
		
		function editRow( idx ) {
			$("#mIdx").val(idx);
			var id = parseInt($("#bodyId"+idx).val());
			$("#mBodyId").val(id);
			$("#mBodyText").val($("#bodyText"+idx).val());
			$("#mCtrlPath").val($("#ctrlPath"+idx).val());
			id = parseInt(id)
			
			switch ( id ) {
				case 0:
					$("#divMessage").html("<h5>Type: Bold Text Only</h5>");
					$("#divBodyText").show();
					$("#divCtrlPath").hide();
					break;
				case 1:
					$("#divMessage").html("<h5>Type: Plain Text Only</h5>");
					$("#divBodyText").show();
					$("#divCtrlPath").hide();
					break;
				case 2:
					$("#divMessage").html("<h5>Type: Image Only</h5>");
					$("#divBodyText").hide();
					$("#divCtrlPath").show();
					break;
				case 3:
					$("#divMessage").html("<h5>Type: Image(Left) and Text(Right)</h5>");
					$("#divBodyText").show();
					$("#divCtrlPath").show();
					break;
				case 4:
					$("#divMessage").html("<h5>Type: Text(Left) and Image(Right)</h5>");
					$("#divBodyText").show();
					$("#divCtrlPath").show();
					break;
				case 5:
					$("#divMessage").html("<h5>Type: Button</h5>");
					$("#divBodyText").show();
					$("#divCtrlPath").show();
					break;
				default:
					$("#divMessage").html("<h5>Type: Spacer. There is nothing to modify.");
					$("#divBodyText").hide();
					$("#divCtrlPath").hide();
					break;
			}

			$('#editModal').modal();
		}
		
		function addRow() {
			$('#addModal').modal();
		}
		
		function addUpdate() {
			var parent = $('#panel-save-body-body');
			var max = 0;
			for ( var i = 0; i < parent.children().length; i++ ) {
				var value = parseInt( parent.children().eq(i).attr('id').replace( "bodyItem", "" ) );
				if ( value > max ) {
					max = value;
				}
			}
			var index = max + 1;
			var bodyId = parseInt( $('input[name="mBodyType"]:checked').val() );
			var bodyTextId = "bodyText"+index;
			var ctrlPathId = "ctrlPath"+index;
			
			var str = "<div id='bodyItem"+index+"' class='body_item col-md-12' style='padding: 5px 0px 5px 0px;'>";
			str += "	<div class='col-md-8'>";
			str += "		<input type='text' id='bodyId"+index+"' value='"+bodyId+"' hidden>";
			str += "		<div class='input-group'>";
			
			switch ( bodyId ) {
				case 0:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
					str += "	<input type='text' class='form-control' id='"+bodyTextId+"' style='font-weight: bold;' readonly value='Dear {{CUSTOMER}} <- Sample Salutation' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='' hidden >";
					break;
				case 1:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
					str += "	<input type='text' class='form-control' id='"+bodyTextId+"' readonly value='This is a sample text: In the end, it's not the years in your life that count. It's the life in your years.' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='' hidden >";
					break;
				case 2:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
					str += "	<input type='text' class='form-control' id='"+ctrlPathId+"' readonly value='http://servicesoft.site11.com/images/sample02.jpg' >";
					str += "	<input type='text' id='"+bodyTextId+"' value='' hidden >";
					break;
				case 3:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
					str += "	<input type='text' class='form-control' id='"+bodyTextId+"' readonly value='This is a sample text: There is more hunger for love and appreciation in this world than for bread.' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='http://servicesoft.site11.com/images/sample01.jpg' hidden >";
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
					break;
				case 4:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-picture'></i></div>";
					str += "	<input type='text' class='form-control' id='"+bodyTextId+"' readonly value='To not live in regret or fear that my past determines the beauty or success of my future, has been one of my life.' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='http://servicesoft.site11.com/images/sample01.jpg' hidden >";
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-text-size'></i></div>";
					break;
				case 5:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-saved'></i></div>";
					str += "	<input type='text' class='form-control' id='"+bodyTextId+"' readonly value='Link to ServiceSoft' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='https://servicesoft.ca/' hidden >";
					break;
				default:
					str += "	<div class='input-group-addon'><i class='glyphicon glyphicon-minus'></i></div>";
					str += "	<input type='text' class='form-control' id='' readonly value='Spacer' >";
					str += "	<input type='text' id='"+ctrlPathId+"' value='' hidden >";
					break;
			}
			
			str += "		</div>";
			str += "	</div>";
			str += "	<div class='col-md-4 text-right'>";
			str += "		<button type='button' class='btn btn-success btn-xs' onclick='editRow("+index+");' data-toggle='tooltip' data-placement='top' title='Edit'><i class='glyphicon glyphicon-eye-open'></i></button>";
			str += "		<div class='btn-group' role='group' aria-label='...'>";
			str += "			<button type='button' class='btn btn-default btn-xs' onclick='moveUp("+index+");' data-toggle='tooltip' data-placement='top' title='Up'><i class='glyphicon glyphicon-chevron-up'></i></button>";
			str += "			<button type='button' class='btn btn-default btn-xs' onclick='moveDown("+index+");' data-toggle='tooltip' data-placement='top' title='Down'><i class='glyphicon glyphicon-chevron-down'></i></button>";
			str += "		</div>";
			str += "		<button type='button' class='btn btn-danger btn-xs' onclick='deleteRow("+index+");' data-toggle='tooltip' data-placement='top' title='Delete'><i class='glyphicon glyphicon-remove'></i></button>";
			str += "	</div>";
			str += "</div>";
			
			parent.append( str );
			//$( str ).appendTo( "#panel-save-body-body" );
			//parent.children().last().after( str );
			//parent.hide().fadeIn('fast'); // refresh
			$( '#addModal' ).modal( 'toggle' );
		}
		
		function update() {
			var id = $("#mIdx").val();
			$( "#bodyText"+id ).val( $("#mBodyText").val() );
			$( "#ctrlPath"+id ).val( $("#mCtrlPath").val() );
			$("#panel-save-body-body").hide().fadeIn('fast');
			$( '#editModal' ).modal( 'toggle' );
		}
		
		function fileSelected() {
			$("#divProgress").css( "width", "0%" ).text("");
			$(".progress").show();
			var file = document.getElementById("fileSelector").files[0];
			var formdata = new FormData();
			formdata.append("selectedFile", file);
			var ajax = new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", completeHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			ajax.open("POST", "file_upload_parser.php");
			ajax.send(formdata);
		}

		function progressHandler(event){
			var percent = ( event.loaded / event.total ) * 100;
			$("#divProgress").css( "width", Math.round(percent) + "%" ).text(Math.round(percent) + " %");
		}
		
		function completeHandler(event){
			$("#mCtrlPath").val( event.target.responseText);
			$(".progress").hide();
		}
		
		function errorHandler(event){
			alert( "Upload Failed" );
			$(".progress").hide();
		}
		
		function abortHandler(event){
			alert( "Upload Aborted" );
			$(".progress").hide();
		}							
		
        function saveMain( param ) {
			var templateId = "<?php echo $template_id ?>";
            if ( param === "header") {
				$("#header-save-btn").button('loading');
                var templateName = $("#inTemplateName").val();
                var width = $("#inWidth").val();
                var subject = $("#inSubject").val();

                var allData = { param: param, templateId: templateId, templateName: templateName, width: width, subject: subject };

                $.ajax({
                    url: "save_and_convert.php",
                    type: "POST",
                    data: allData,
                    datatype: "text",
                    success:function( result ) {
                        $("#dispTemplateName").html(templateName);
						$('#dispOutput')[0].contentWindow.location.reload(true);
						$("#header-save-btn").button('reset');
                    },
                    error:function(jqXHR, textStatus, errorThrown) { 
						$("#header-save-btn").button('reset');
                        alert("Error: \n" + textStatus + " : " + errorThrown);
                    }
                });

            } else if ( param === "footer" ) {
				$("#footer-save-btn").button('loading');
                var companyName = $("#inCompanyName").val();
				var companyPhone = $("#inCompanyPhone").val();
                var companyEmail = $("#inCompanyEmail").val();
				var companyAddress = $("#inCompanyAddress").val();
                var companyFacebook = $("#inCompanyFacebook").val();
				var companyTwitter = $("#inCompanyTwitter").val();
				var companyGooglePlus = $("#inCompanyGooglePlus").val();
				var companyInstagram = $("#inCompanyInstagram").val();

                var allData = { param: param, templateId: templateId, companyName: companyName, companyPhone: companyPhone, 
					companyEmail: companyEmail, companyAddress: companyAddress, companyFacebook: companyFacebook, 
					companyTwitter: companyTwitter, companyGooglePlus: companyGooglePlus, companyInstagram: companyInstagram };

                $.ajax({
                    url: "save_and_convert.php",
                    type: "POST",
                    data: allData,
                    datatype: "text",
                    success:function( result ) {
						$('#dispOutput')[0].contentWindow.location.reload(true);
						$("#footer-save-btn").button('reset');
                    },
                    error:function(jqXHR, textStatus, errorThrown) { 
						$("#footer-save-btn").button('reset');
                        alert("Error: \n" + textStatus + " : " + errorThrown);
                    }
                });
            } else {
				$("#body-save-btn").button('loading');
				var all = $('#panel-save-body-body').children();
				var contents = new Array();
				for (var i = 0; i < all.length; i++) {
					contents[i] = new Array();
					var str = all.eq(i).attr("id");
					var idx = str.replace("bodyItem", ""); // Get index
					contents[i][0] = $("#bodyId"+idx).val();
					contents[i][1]= $("#ctrlPath"+idx).val();
					contents[i][2] = $("#bodyText"+idx).val();
				}
				var jsonContents = {};
				jsonContents = JSON.stringify(contents);
				var allData = { param: param, templateId: templateId, jsonContents: jsonContents };

				$.ajax({
                    url: "save_and_convert.php",
					cache: false,
                    type: "POST",
                    data: allData,
                    datatype: "json",
                    success:function( result ) {
						$('#dispOutput')[0].contentWindow.location.reload(true);
						$("#body-save-btn").button('reset');
                    },
                    error:function(jqXHR, textStatus, errorThrown) { 
						$("#body-save-btn").button('reset');
                        alert("Error: " + textStatus + " : " + errorThrown);
                    }
                });
			}
        }
	</script>
<?php include './footer.php'; ?>