<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MM - Screens</title>
        <link rel="stylesheet" href="<?php echo \app\config\Settings::CSS_PATH;?>app.css">
    </head>

    <body>
        <main id="main" class="screen-wrapper <?php echo $data['screen'][0]->getMode(); ?>">
        