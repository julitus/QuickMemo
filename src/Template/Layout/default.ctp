<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Quick Memo, que fácil recordar';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!--?= $this->Html->meta('qmemo') ?-->
    <?= $this->Html->meta(
            'qmemo.ico',
            '/qmemo.ico',
            ['type' => 'icon']
        ) ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('bootstrap-tagsinput.css') ?>

    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('bootstrap-tagsinput.js') ?>

    <?= $this->Html->css('slider.css') ?>

    <?= $this->Html->script('modernizr.custom.28468.js') ?>
    <?= $this->Html->script('jquery.cslider.js') ?>
    <script type="text/javascript">
        $(function() {

            $('#da-slider').cslider({
                autoplay : true,
                bgincrement : 450
            });

        });
    </script>

    <?= $this->Html->css('owl.carousel.css') ?>
    <?= $this->Html->script('owl.carousel.js') ?>
    <script>
        $(document).ready(function() {

            $("#owl-demo").owlCarousel({
                items : 4,
                lazyLoad : true,
                autoPlay : true,
                navigation : true,
                navigationText : ["", ""],
                rewindNav : false,
                scrollPerPage : false,
                pagination : false,
                paginationNumbers : false,
            });

        });
    </script>

    <?= $this->Html->css('font-awesome.min.css') ?>

    <?= $this->Html->script('functions.js') ?>
    <!--?= $this->Html->css('base.css') ?-->
    <!--?= $this->Html->css('cake.css') ?-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <!--nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav-->
    <?= $this->element('header') ?> 
    <!--div class="container clearfix"-->
    <?= $this->fetch('content') ?>
    <!--/div-->
    <?= $this->element('footer') ?> 

</body>
</html>
