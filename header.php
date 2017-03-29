<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Service Soft Template Creator</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- minified Bootstrap Modal Dialog CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
		body {
			padding-top: 90px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
		}

		.portfolio-item {
			margin-bottom: 25px;
		}

		footer {
			margin: 50px 0;
		}
		
		.spacer{
			margin-top: 20px;
			margin-bottom: 20px;
		}
		
		.modal-header-danger {
			color:#fff;
			padding:9px 15px;
			border-bottom:1px solid #eee;
			background-color: #d9534f;
			-webkit-border-top-left-radius: 5px;
			-webkit-border-top-right-radius: 5px;
			-moz-border-radius-topleft: 5px;
			-moz-border-radius-topright: 5px;
			border-top-left-radius: 5px;
			border-top-right-radius: 5px;
		}
    </style>
  </head>
  <body>
    <!-- Navigation -------------------------------------------------------------------->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display ---------------->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Service Soft</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="./list.php">Template List</a></li>
                    <li><a data-toggle="modal"  href="#myModal1">AC Developer</a></li>
                </ul>
            </div>
            <!-- End of navbar-collapse ------------------------------------------------>
        </div>
        <!-- End of container ---------------------------------------------------------->
    </nav>

	<!-- Modal ------------------------------------------------------------------------->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">AC Developer</h4>
				</div>
				<div class="modal-body">
					<ul>
						<li>Leader: Patrick Griffith (<a href="mailto://grif0182@algonquinlive.com">grif0182@algonquinlive.com</a>)</li>
						<li>Member: Adolfo Cardonatesillo (<a href="mailto://card0129@algonquinlive.com">card0129@algonquinlive.com</a>)</li>
						<li>Member: Byungseon Kim (<a href="mailto://kim00331@algonquinlive.com">kim00331@algonquinlive.com</a>)</li>
						<li>Member: Rajumeshbhai Nasit (<a href="mailto://nasi0023@algonquinlive.com">nasi0023@algonquinlive.com</a>)</li>
						<li>Member: Vijaykumar Jinka (<a href="mailto://jink0005@algonquinlive.com">jink0005@algonquinlive.com</a>)</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div> <!-- End of modal-content ------------------------------------------->
		</div> <!-- End of modal-dialog ------------------------------------------------>
	</div> <!-- End of Modal ----------------------------------------------------------->	
