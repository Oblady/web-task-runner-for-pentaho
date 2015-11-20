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
        <legend><?= __('Add Migrations Parameter') ?></legend>
        <?php
            echo $this->Form->input('migration_id', ['options' => $migrations, 'empty' => true]);
            echo $this->Form->input('task_id');
            echo $this->Form->input('parameter_id', ['options' => $parameters, 'empty' => true]);
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
