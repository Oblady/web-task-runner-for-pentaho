<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
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
        <legend>Éditer la valeur du paramètre <code>${<?= $parameters->toArray()[$this->request->query['parameter_id']] ?>}</code> pour la migration <em><?= $migrations->toArray()[$this->request->query['migration_id']] ?></em></legend>
        <?php
            echo $this->Form->input('value',['label' => 'Valeur du paramètre']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
