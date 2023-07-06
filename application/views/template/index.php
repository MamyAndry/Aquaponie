<!DOCTYPE html>
<html lang="en" class="scroll-behavior-smooth">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/Font/fontawesome-5/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/Font/fontawesome-6/css/all.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/aos/dist/aos.css'); ?>">

	<title>
		<?php echo $page_title; ?>
	</title>

	<style>
		.footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 5vh;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }
	</style>
</head>
<body>
	<div class="container-fluid" style="--bs-gutter-x: 0em; ">
		<?php 
			$this->load->view('template/Header');
			$this->load->view( $body );
		?>
	</div>

	<div class="footer">
		<?php $this->load->view('template/Footer'); ?>
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
    <script src="<?php echo base_url('assets/js/scroll.js')?>"></script>
</body>
</html>