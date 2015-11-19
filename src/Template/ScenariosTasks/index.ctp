<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Scenarios Task'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="scenariosTasks index large-9 medium-8 columns content">
    <h3><?= __('Scenarios Tasks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('scenario_id') ?></th>
                <th><?= $this->Paginator->sort('task_id') ?></th>
                <th><?= $this->Paginator->sort('order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scenariosTasks as $scenariosTask): ?>
            <tr>
                <td><?= $this->Number->format($scenariosTask->id) ?></td>
                <td><?= $scenariosTask->has('scenario') ? $this->Html->link($scenariosTask->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $scenariosTask->scenario->id]) : '' ?></td>
                <td><?= $scenariosTask->has('task') ? $this->Html->link($scenariosTask->task->name, ['controller' => 'Tasks', 'action' => 'view', $scenariosTask->task->id]) : '' ?></td>
                <td><?= $this->Number->format($scenariosTask->order) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $scenariosTask->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $scenariosTask->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $scenariosTask->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scenariosTask->id)]) ?>
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
