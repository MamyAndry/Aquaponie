<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/Font/fontawesome-5/css/all.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/aos/dist/aos.css'); ?>">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	
	<title>
		<?php echo $page_title; ?>

	</title>
</head>
<body>
	<div class="container-fluid" style="--bs-gutter-x: 0em; ">
		<?php 
			$this->load->view('template/Header');
			$this->load->view( $body );
			$this->load->view('template/Footer');
		?>
	</div>

	<script src="<?php echo base_url('assets/aos/dist/aos.js'); ?>"></script>
	<script>
		AOS.init({
            easing: 'ease-in-out',
            duration : '1000',
        });
	</script>
    <script src="<?php echo base_url('assets/js/app.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"></script>
</body>
</html>