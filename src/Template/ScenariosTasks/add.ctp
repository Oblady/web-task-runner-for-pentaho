<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Scenarios Tasks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="scenariosTasks form large-9 medium-8 columns content">
    <?= $this->Form->create($scenariosTask) ?>
    <fieldset>
        <legend><?= __('Add Scenarios Task') ?></legend>
        <?php
            echo $this->Form->input('scenario_id', ['options' => $scenarios, 'empty' => true]);
            echo $this->Form->input('task_id', ['options' => $tasks, 'empty' => true]);
            echo $this->Form->input('order');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
