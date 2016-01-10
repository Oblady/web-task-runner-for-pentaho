<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Pentaho Web Runner |
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('modal.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="">Pentaho Web Runner .::. <?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <ul class="left">
                <li><?= $this->Html->link(
                    '<i class="fa fa-usd"></i> Paramètres',
                    '/parameters',
                    ['escape' => false]
                ); ?></li>
                <li><?= $this->Html->link(
                        '<i class="fa fa-list"></i> Tâches',
                        '/tasks',
                        ['escape' => false]
                    ); ?></li>
                <li><?= $this->Html->link(
                        '<i class="fa fa-list-alt"></i> Scénarios',
                        '/scenarios',
                        ['escape' => false]
                    ); ?></li>
                <li><?= $this->Html->link(
                        '<i class="fa fa-cogs"></i> Migrations',
                        '/migrations',
                        ['escape' => false]
                    ); ?></li>
            </ul>
            <ul class="right">
                <li><a target="_blank" href="https://twitter.com/obladycms">Conçu avec <i class="fa fa-heart"></i> par @ObladyCMS</a></li>
            </ul>
        </section>
    </nav>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
    <?= $this->fetch('script') ?>
</body>
</html>
