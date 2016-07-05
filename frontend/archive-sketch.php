<?php
	if (!defined('ABSPATH')) exit;

	if (isset($_POST["post"])) {
		require_once(plugin_dir_path(__FILE__) . 'upload.php');
		sketch_upload();
		die();
	}
?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<head>

	<meta charset="utf-8"/>
	<title>Upload Sketch</title>
	<meta name="robots" content="noindex,nofollow"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400"/>

	<style>
		body{
			color:#0f3c4b;
			font-family:Roboto, sans-serif;
			padding:100px 0 0 0;
			background-color:#e5edf1;
		}

		iframe{
			display:none;
		}
		.container{
			width:100%;
			max-width:680px;
			text-align:center;
			margin:0 auto;
		}

		.container h1{
			font-size:42px;
			font-weight:300;
			color:#0f3c4b;
			margin-bottom:40px;
		}

		form{
			font-size:20px;
			position:relative;
			height:130px;
			padding:60px 20px 0 20px;
			background-color:#c8dadf;
		}

		#box_uploading,
		#box_success,
		#box_error{
			display:none;
			font-size:18px;
			margin:10px 0 0 0;
		}

		.box_file{
			width:0.1px;
			height:0.1px;
			opacity:0;
			overflow:hidden;
			position:absolute;
			z-index:-1;
		}

		label{
			font-weight:bold;
			max-width:80%;
			text-overflow:ellipsis;
			white-space:nowrap;
			cursor:pointer;
			display:inline-block;
			overflow:hidden;
		}

		.box_file + label:hover,
		.box_file:focus + label,
		.box_file.has-focus + label{
			color:#39bfd3;
		}

		.box_file:focus + label,
		.box_file.has-focus + label{
			outline:1px dotted #000;
			outline:-webkit-focus-ring-color auto 5px;
		}

		.box_button{
			font-weight:700;
			color:#e5edf1;
			background-color:#39bfd3;
			display:none;
			padding:8px 16px;
			margin:40px auto 0;
		}

		.box_button:hover,
		.box_button:focus{
			background-color:#0f3c4b;
		}

		/********************/
		#results{
			font-size:18px;
			line-height:30px;
			text-align:center;

			display:none;;
			position:relative;
			padding:30px 20px 10px 20px;;
			margin:20px auto 20px auto;
			background-color:#c8dadf;
		}

		#results h2{
			font-size:20px;
			font-weight:bold;
			line-height:30px;
			text-align:center;
			margin: 0 0 5px 0;
		}

		a:link,
		a:active,
		a:visited,
		a:hover{
			color:#000;
			text-decoration:underline;
		}

		a:visited{
			color:purple;
		}

		a:hover{
			color:#39bfd3;
		}

	</style>
</head>

<body>

	<div class="container" role="main">
		<iframe src="about:blank" id="_sketch_post_frame" name="_sketch_post_frame"></iframe>
		<h1>Upload a sketch image<br />to see inside the browser</h1>
		<form method="post" action="" enctype="multipart/form-data" novalidate target="_sketch_post_frame">
			<div id="box_input">
				<input type="hidden" name="post" value="1" />
				<input type="file" name="sketch_files[]" id="sketch_files" class="box_file" multiple/>
				<label id="box_label" for="sketch_files">Click to choose jpg/png files(s).</label>
				<button type="submit" class="box_button">Upload</button>
			</div>
			<div id="box_uploading">Uploading&hellip;</div>
			<div id="box_error"></div>
			<div id="box_success"><strong>Done!</strong> see links below.<br />You may upload more!</div>
		</form>
		<div id="results"><h2>Results:</h2></div>
	</div>

	<script>
		var uplForm = document.querySelectorAll('form')[0],
			input = uplForm.querySelector('input[type="file"]');

		input.addEventListener('change', function (e) {
			if(input.value) sketch_form_submit()
		});

		function sketch_form_submit() {
			uplForm.submit()
			document.getElementById("box_error").style.display = "none";
			document.getElementById("box_success").style.display = "none";
			document.getElementById("box_uploading").style.display = "block";
		}

		function sketch_error_msg(msg) {
			document.getElementById("box_error").innerHTML = "Error! " + msg
			document.getElementById("box_error").style.display = "block";
			document.getElementById("box_uploading").style.display = "none";
		}

		function sketch_success_msg(links) {
			document.getElementById("results").innerHTML = document.getElementById("results").innerHTML + links;
			document.getElementById("results").style.display = "block";
			document.getElementById("box_success").style.display = "block";
			document.getElementById("box_uploading").style.display = "none";
		}

		function sketch_form_restart() {
			document.getElementById("box_success").style.display = "none";
			document.getElementById("box_error").style.display = "none";
			document.getElementById("box_uploading").style.display = "none";
			document.getElementById("box_input").style.display = "block";
		}
	</script>

</body>

</html>