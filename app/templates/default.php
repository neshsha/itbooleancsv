<?php global $r; ?>
<!DOCTYPE html>
<html lang="<?=$r->lang !== '' ? $r->lang : 'sr'?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $r->title ?></title>

	<meta name="author"             content="<?=$r->author?>" />
	<meta name="description"        content="<?=$r->description?>" />
	<meta name="keywords"           content="<?=$r->keywords?>" />
	<meta property="fb:app_id"      content="<?=FB_APP_ID?>" /> 
	<meta property="og:type"        content="article" /> 
	<meta property="og:url"         content="<?='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>" /> 
	<meta property="og:title"       content="<?=$r->title?>" /> 
	<meta property="og:image"       content="<?=$r->url($r->og_image)?>" />
	<meta property="og:description" content="<?=$r->description?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


	<link rel="shortcut icon" href="<?=$r->url('favicon.ico')?>" type="image/x-icon">
	<link rel="icon" type="image/png" href="<?=$r->url('favicon.png')?>">

	<link rel="stylesheet" href="<?=$r->url('css/w3.css')?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

	<script src="https://use.fontawesome.com/60bc0eaa28.js"></script>

	<link rel="stylesheet" href="<?=$r->url('css/styles_v01.css')?>" />

	<link rel="stylesheet" href="css/dropzone.css" />

	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<script src="js/dropzone.js"></script>

	<script src="https://www.google.com/recaptcha/api.js"></script>

<!-- include summernote css/js -->
<link href="<?= $r->url('css/summernote-lite.min.css')?>" rel="stylesheet">
<script src="<?= $r->url('js/summernote-lite.min.js')?>"></script>

<!-- include summernote-ko-KR -->
<script src="<?= $r->url('js/lang/summernote-sr-RS-Latin.js')?>"></script>

<?= $r->styles ?>
<?= $r->script ?>
</head>
<body<?=$r->page() !== '' ? ' id="page_'.$r->page().'"' : ''?>>
	<header>
		<?php include_once $r->header !== '' ? $r->header : __DIR__.'/includes/header.php'; ?>
	</header>
	<main>
		<?php 

		$r->main !== '' ? include_once $r->main : null;
		?>
	</main>
	<footer>
		<?php include_once $r->footer !== '' ? $r->footer : __DIR__.'/includes/footer.php'; ?>
	</footer>
</body>
</html>