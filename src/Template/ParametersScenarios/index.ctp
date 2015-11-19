<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Parameters Scenario'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="parametersScenarios index large-9 medium-8 columns content">
    <h3><?= __('Parameters Scenarios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('parameter_id') ?></th>
                <th><?= $this->Paginator->sort('scenario_id') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parametersScenarios as $parametersScenario): ?>
            <tr>
                <td><?= $this->Number->format($parametersScenario->id) ?></td>
                <td><?= $parametersScenario->has('parameter') ? $this->Html->link($parametersScenario->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $parametersScenario->parameter->id]) : '' ?></td>
                <td><?= $parametersScenario->has('scenario') ? $this->Html->link($parametersScenario->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $parametersScenario->scenario->id]) : '' ?></td>
                <td><?= h($parametersScenario->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $parametersScenario->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $parametersScenario->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $parametersScenario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parametersScenario->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
