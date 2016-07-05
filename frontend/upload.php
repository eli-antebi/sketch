<?php
	function sketch_generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function sketch_check_file_type($fileName)
	{
		preg_match('/[^\?]+\.(jpe?g|jpe|jpg|gif|png)\b/i', $fileName, $matches);
		return $matches[0];
	}

	function sketch_file_too_large($fileSize)
	{
		return $fileSize > (10 * 1000000); // 10m
	}

	function sketch_handle_attachment($file_handler, $post_id, $set_thu = false)
	{
		// check to make sure its a successful upload
		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');

		return media_handle_upload($file_handler, $post_id);
	}

	function sketch_upload()
	{
		$sketch_upload_error = "";
		$sketch_uploaded_links = "";

		if ($_FILES) {
			$files = $_FILES["sketch_files"];
			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key]) {

					// get file info
					$file = array(
						'name' => $files['name'][$key],
						'type' => $files['type'][$key],
						'tmp_name' => $files['tmp_name'][$key],
						'error' => $files['error'][$key],
						'size' => $files['size'][$key]
					);

					$filename = pathinfo($file[name], PATHINFO_FILENAME);


					// check file ext
					if (!sketch_check_file_type($file[name])) {
						$sketch_upload_error = "bad file type, you can upload jpg/png only";
					};

					// check file size
					if (sketch_file_too_large($file[size])) {
						$sketch_upload_error = "file is too large, maximum allowed is 10m";
					};

					// upload to server
					if (!$sketch_upload_error) {
						$_FILES = array("sketch_files" => $file);
						foreach ($_FILES as $file => $array) {
							$newupload = sketch_handle_attachment($file, $pid);
						}
					}

					// create post
					if (!$sketch_upload_error) {
						$postarr = array(
							"post_title" => $filename,
							"post_status" => "publish",
							"post_type" => "sketch",
							"post_name" => $filename . "-" . sketch_generateRandomString(5)
						);

						$post_id = wp_insert_post($postarr, $wp_error = false);

						if ($post_id === 0) {
							$sketch_upload_error = "error creating post";
						} else {
							$uploaded = set_post_thumbnail($post_id, $newupload);
							if (!$uploaded) {
								$sketch_upload_error = "error uploading file";
							} else {
								$permalink = get_permalink($post_id);
								$sketch_uploaded_links .= '<a href="' . $permalink . '" target="_blank">' . $permalink . '</a><br />';
							}
						}
					}
				}
				else{
					$sketch_upload_error = "no files";
				}
			}
		} else {
			$sketch_upload_error = "no files";
		}

		if ($sketch_upload_error) {
			echo "<script>top.sketch_error_msg('" . $sketch_upload_error . "');</script>";
		} else {
			echo "<script>top.sketch_success_msg('" . $sketch_uploaded_links . "');</script>";
		}
	}
