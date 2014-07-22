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

		function list_year(){
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
					echo '<a href="index.php?year='.$year.'&month='.getLastMonthByYear($year).'">'.$year.'</a><br>';
			}
			echo "<br>";
			list_month($years);
		}

		function list_month(){
			global $exclude_list, $install_path;
			$months = array_diff(scandir($install_path.$_GET['year']), $exclude_list);
			foreach ($months as $month) {
				$todayMonth = date("m");
				if ($month == $todayMonth)
					echo $month.'<br>';
				else
					echo '<a href="index.php?year='.$_GET["year"].'&month'.$_GET["month"].'">'.$month.'</a><br>';
			}
			list_day();
		}

		function list_day(){
			global $exclude_list, $install_path;
			$days = array_diff(scandir($install_path.$_GET['year']."/".$_GET['month']), $exclude_list);
			foreach ($days as $day) {
				$files = array_diff(scandir($install_path.$_GET['year']."/".$_GET['month']."/".$day), $exclude_list);
				echo $day.'<br>';
				foreach ($files as $file) {
					echo $file."<br>";
				}
			}
		}

		function getLastDefaultDate(){
			global $exclude_list, $install_path;
			$tempYears = array_diff(scandir($install_path), $exclude_list);
			$i = 0;
			foreach ($tempYears as $tempYear) {
				$years[$i] = $tempYear;
				++$i;
			}
			$_GET['year'] = $years[count($years)-1];

			$tempMonths = array_diff(scandir($install_path.$_GET['year']), $exclude_list);
			$i = 0;
			foreach ($tempMonths as $tempMonth) {
				$months[$i] = $tempMonth;
				++$i;
			}
			$_GET['month'] = $months[count($months)-1];
		}

		function getLastMonthByYear($year){
			global $exclude_list, $install_path;
			$tempMonths = array_diff(scandir($install_path.$year), $exclude_list);
			$i = 0;
			foreach ($tempMonths as $tempMonth) {
				$months[$i] = $tempMonth;
				++$i;
			}
			return $months[count($months)-1];
		}

		/* Start program */
		if ($_GET['year'] == null) getLastDefaultDate();
		
		list_year();

	 ?>
</body>
</html>