<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Migrations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migrations form large-9 medium-8 columns content">
    <?= $this->Form->create($migration) ?>
    <fieldset>
        <legend><?= __('Add Migration') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('scenario_id', ['options' => $scenarios, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
