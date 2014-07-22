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
			$tempYears = array_diff(scandir($install_path), $exclude_list);
			$i = 0;
			foreach ($tempYears as $tempYear) {
				$years[$i] = $tempYear;
				++$i;
			}
			foreach ($years as $year) {
				if ($year == $_GET['year'])
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
				if ($month == $_GET['month'])
					echo transformIntToMonth($month).'<br>';
				else
					echo '<a href="index.php?year='.$_GET["year"].'&month='.$month.'">'.transformIntToMonth($month).'</a><br>';
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
					$linkFile = $install_path.$_GET['year']."/".$_GET['month']."/".$day."/".$file;
					if (checkFileIsImage($linkFile)){
						$newFormatLink = str_replace(" ", "%20", $linkFile);
						$newFormatFile = str_replace(" ", "%20", $file);
						echo "<a href='".$newFormatLink."'><img src='".$newFormatLink."' width='106' height='106' alt='".$newFormatFile."'></a>";
					}
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

		function transformIntToMonth($int){
			if ($int == 01)
				return "January";
			if ($int == 02)
				return "February";
			if ($int == 03)
				return "March";
			if ($int == 04)
				return "April";
			if ($int == 05)
				return "May";
			if ($int == 06)
				return "June";
			if ($int == 07)
				return "July";
			if ($int == 08)
				return "August";
			if ($int == 09)
				return "September";
			if ($int == 10)
				return "October";
			if ($int == 11)
				return "November";
			if ($int == 12)
				return "December";
		}

		/* Start program */
		if ($_GET['year'] == null || $_GET['month'] == null) {
			getLastDefaultDate();
			header("Location: index.php?year=".$_GET['year']."&month=".$_GET['month']);
		}
		
		list_year();

	 ?>
</body>
</html>