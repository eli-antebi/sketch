<!doctype html>

<html lang="en_US" dir="ltr">

<head>

	<meta charset="utf-8"/>
	<meta name="robots" content="noindex,nofollow"/>
	<title>Sketch</title>
	<link type="text/css" rel="stylesheet" href="<?= site_url() ?>/wp-content/plugins/sketch/frontend/style.css"/>

</head>

<body>

	<img id="img" src="<?= the_post_thumbnail_url(' full ') ?>" alt="" onload="sketch_init_viewport()"/>
	<div id="bg" style="background-image:url(<?= the_post_thumbnail_url(' full ') ?>)"></div>
	<div class="line line1280"></div>
	<div class="line line1366"></div>
	<div class="line line1440"></div>
	<div class="line line1920"></div>

	<div class="infoBar">
		<div id="userData"></div>
		<div id="closeBtn" class="infoBtn" onclick="sketch_info_close()">X</div>
		<div id="openBtn" class="infoBtn" onclick="sketch_info_open()">i</div>
	</div>

	<script src="<?= site_url() ?>/wp-content/plugins/sketch/frontend/detectZoom.js"></script>
	<script src="<?= site_url() ?>/wp-content/plugins/sketch/frontend/script.js"></script>

</body>

</html>