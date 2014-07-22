<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
		<meta charset="UTF-8">
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<title>lisf2</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
<body>
	<?php 

		$install_path = "./";
		$exclude_list = array(".", "..", ".git", ".gitignore", "README.md", "index.php", ".DS_Store");

		/* Function */
		function checkFileIsImage($file){
			$isImage = false;

			$imgMimeType = array(
				'image/png',
				'image/jpeg',
				'image/jpeg',
				'image/jpeg',
				'image/gif',
				'image/bmp',
				'image/vnd.microsoft.icon',
				'image/tiff',
				'image/tiff',
				'image/svg+xml',
				'image/svg+xml'
				);

			foreach ($imgMimeType as $type) {
				if(mime_content_type($file) == $type){
					$isImage = true;
				}
			}
			return $isImage;
		}

		function list_year()
		{
			global $exclude_list, $install_path;
			$todayYear = date("Y");
			$tempYears = array_diff(scandir($install_path), $exclude_list);
			$i = 0;
			foreach ($tempYears as $tempYear) {
				$years[$i] = $tempYear;
				++$i;
			}
			foreach ($years as $year) {
				if ($year == $todayYear)
					echo $year.'<br>';
				else
					echo '<a href="#">'.$year.'</a><br>';
			}
			echo "<br>";
			list_month($years);
		}

		function list_month($years)
		{
			global $exclude_list, $install_path;
			$todayYear = date("Y");
			$yearsCount = count($years);
			$year = $years[$yearsCount - 1];
			$months = array_diff(scandir($install_path.$year), $exclude_list);
			foreach ($months as $month) {
				echo '<a href="#">'.$month.'</a><br>';
			}
		}

		/* Start program */
		list_year();

	 ?>
</body>
</html>