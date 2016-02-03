<?php
/**
 * This file is part of Web Task Runner for Pentaho Data Integration.
 *
 * Web Task Runner for Pentaho Data Integration is free software: you
 * can redistribute it and/or modify it under the terms of the GNU
 * Affero General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option)
 * any later version.
 *
 * Web Task Runner for Pentaho Data Integration is distributed in the
 * hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Affero General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Web Task Runner |
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
                <h1><a href="#"><?= $this->Html->image('logo.png',['style'=>'margin-top:-5px; margin-right:5px;']); ?>Web Task Runner <sub>pour <em> Pentaho<sup>®</sup> <abbr style="color:white;" title="Data Integration">DI</abbr></em></sub></a></h1>
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
