<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $migrationsParameter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $migrationsParameter->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Migrations Parameters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Migrations'), ['controller' => 'Migrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Migration'), ['controller' => 'Migrations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migrationsParameters form large-9 medium-8 columns content">
    <?= $this->Form->create($migrationsParameter) ?>
    <fieldset>
        <legend>Éditer la valeur du paramètre <code>${<?= $migrationsParameter->parameter->name ?>}</code> pour la migration <em><?= $migrationsParameter->migration->name ?></em></legend>
        <?php
            echo $this->Form->input('value', ['label' => 'Valeur du paramètre']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
