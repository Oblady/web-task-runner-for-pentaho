<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Parameters Scenarios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parametersScenarios form large-9 medium-8 columns content">
    <?= $this->Form->create($parametersScenario) ?>
    <fieldset>
        <legend><?= __('Add Parameters Scenario') ?></legend>
        <?php
            echo $this->Form->input('parameter_id', ['options' => $parameters, 'empty' => true]);
            echo $this->Form->input('scenario_id', ['options' => $scenarios, 'empty' => true]);
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
