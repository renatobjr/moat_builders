<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title><?php echo $title ?></title>
</head>

<body>
	<div class="hide-on-med-and-down">
		<nav class="grey lighten-5">
			<div class="nav-wrapper">
				<a href="<?php echo base_url('dashboard') ?>" id="logo-container" class="brand-logo">
					<img src="<?php echo base_url('logo.svg') ?>" alt="" class="responsive-img" style="height: 3vh; padding-left: 4vh; margin-top:1vh">
				</a>
				<ul>
					<li class="right">
						<a href="<?php echo base_url('logout') ?>">
							<i class="material-icons black-text">logout</i>
						</a>
					</li>
					<li class="right">
						<a href="<?php echo base_url('dashboard/new-album') ?>">
							<i class="material-icons black-text">album</i>
						</a>
					</li>
					<li class="right"><a class="black-text light" href="#"><?php echo $_SESSION['fullname']?></a></li>
				</ul>
			</div>
		</nav>
	</div>