<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $scenario->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $scenario->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="scenarios form large-9 medium-8 columns content">
    <?= $this->Form->create($scenario) ?>
    <fieldset>
        <legend><?= __('Edit Scenario') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('parameters._ids', ['options' => $parameters]);
            echo $this->Form->input('tasks._ids', ['options' => $tasks]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
