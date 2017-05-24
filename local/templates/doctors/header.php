<!doctype html>
<!--Conditionals for IE8-9 Support-->
<!--[if IE]><html lang="ru" class="ie"><![endif]-->
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />
        <title><?$APPLICATION->ShowTitle()?></title>
		<meta charset="<?=LANG_CHARSET?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <? 
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css");
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/libs/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css");
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/main.css");
        ?>
        <?$APPLICATION->ShowHead();?>
    </head>
    <body>
        <div id="panel"><?$APPLICATION->ShowPanel();?></div>
        <div class="wrapper">