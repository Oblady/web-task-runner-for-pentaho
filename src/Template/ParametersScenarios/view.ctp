<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameters Scenario'), ['action' => 'edit', $parametersScenario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameters Scenario'), ['action' => 'delete', $parametersScenario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametersScenario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameters Scenarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameters Scenario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parametersScenarios view large-9 medium-8 columns content">
    <h3><?= h($parametersScenario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= $parametersScenario->has('parameter') ? $this->Html->link($parametersScenario->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $parametersScenario->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Scenario') ?></th>
            <td><?= $parametersScenario->has('scenario') ? $this->Html->link($parametersScenario->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $parametersScenario->scenario->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($parametersScenario->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parametersScenario->id) ?></td>
        </tr>
    </table>
</div>
