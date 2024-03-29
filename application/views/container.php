<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  	<meta http-equiv="content-language" content="sk" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<meta name="language" content="sk" />
  	<meta name="description" content="Web obcianskeho zdruzenia a exkurzii" />
  	<meta name="keywords" content="obcianske zdruzenie, exkurzie, FMFI, uniba" />
        <meta name="author" content="TIS: Tutifruty Team" />
        <title><?= $title ?></title>
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	 <!--[if IE]>    <link href="<?= base_url(); ?>assets/css/ie-only.css" rel="stylesheet" type="text/css" media="screen" /><![endif]-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/custom.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    </head>
    <body>
	<noscript><?= $this->lang->line('no_js'); ?></noscript>
        <div> <!-- wrapper -->
            <div> <!-- header -->
               <?= $this->load->view('header_view') ?>
            </div>
            <div> <!-- content -->
                <?= $this->load->view('content_view', $view) ?>
            </div>
            <div> <!-- footer -->
                <?= $this->load->view('footer_view') ?>
            </div>
        </div>
    </body>
</html> 