<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Assesment Test for Web Developer v2</title>
	<style>
		body{
		}
		
		.center {
			margin: auto;
			width: 60%;
			border: 3px solid #73AD21;
			padding: 10px;
		}
		#table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		#table td, #table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		#table tr:nth-child(even){background-color: #f2f2f2;color:black;}
		#table tr:nth-child(odd){color:black;}
		#table tr:hover {background-color: #ddd;}

		#table th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}
	</style>
	<!-- CSS -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/bootstrap/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/font-awesome/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/css/form-elements.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assetForHome/css/style.css') ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="<?php echo base_url('assetForHome/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assetForHome/js/jquery.backstretch.min.js') ?>" ></script>
	<script src="<?php echo base_url('assetForHome/js/scripts.js') ?>"></script>
</head>
<body style="background-image:url('<?php echo base_url('bg.png')?>')">
	<div class="center">
	<p style="text-align:center;">
		<a href="<?php echo site_url('home');?>">Dashboard</a> - 
		<a href="<?php echo site_url('dkota');?>">Daftar Kota</a>
	</p>
	</div>
	
	<?php
	if($history != null)
	{
		echo '<table id="table" class="" style="width:60%;margin:auto;">';
		echo '<tr style="border:1px solid black;">';
		echo '<th style="text-align:center;">Title Search</th>';
		echo '<th style="text-align:center;">Date Time</th>';
		echo '</tr>';
		foreach($history as $history_search)
		{
			echo '<tr>';
			echo '<td style="text-align:center;">'.$history_search->text.'</td>';
			echo '<td style="text-align:center;">'.$history_search->datetime.'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
		
	?>
	
	
</body>
</html>