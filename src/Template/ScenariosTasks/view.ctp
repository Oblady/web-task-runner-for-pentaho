<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Scenarios Task'), ['action' => 'edit', $scenariosTask->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Scenarios Task'), ['action' => 'delete', $scenariosTask->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scenariosTask->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenarios Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="scenariosTasks view large-9 medium-8 columns content">
    <h3><?= h($scenariosTask->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Scenario') ?></th>
            <td><?= $scenariosTask->has('scenario') ? $this->Html->link($scenariosTask->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $scenariosTask->scenario->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Task') ?></th>
            <td><?= $scenariosTask->has('task') ? $this->Html->link($scenariosTask->task->name, ['controller' => 'Tasks', 'action' => 'view', $scenariosTask->task->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($scenariosTask->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Order') ?></th>
            <td><?= $this->Number->format($scenariosTask->order) ?></td>
        </tr>
    </table>
</div>
