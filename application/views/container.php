<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  	<meta http-equiv="content-language" content="sk" />
  	<meta name="language" content="sk" />
  	<meta name="description" content="Web obcianskeho zdruzenia a exkurzii" />
  	<meta name="keywords" content="obcianske zdruzenie, exkurzie, FMFI, uniba" />
        <meta name="author" content="TIS: Tutifruty Team" />
        <title><?= $title ?></title>
        <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
        <div>//wrapper
            <div> //header
               <?= $this->load->view('header_view') ?>
            </div>
            <div> //content
                <?= $this->load->view('content_view', $view) ?>
            </div>
            <div> //footer
                <?= $this->load->view('footer_view') ?>
            </div>
        </div>
    </body>
</html> 