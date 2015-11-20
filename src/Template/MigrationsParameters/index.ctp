<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Migrations Parameter'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Migrations'), ['controller' => 'Migrations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Migration'), ['controller' => 'Migrations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migrationsParameters index large-9 medium-8 columns content">
    <h3><?= __('Migrations Parameters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('migration_id') ?></th>
                <th><?= $this->Paginator->sort('task_id') ?></th>
                <th><?= $this->Paginator->sort('parameter_id') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migrationsParameters as $migrationsParameter): ?>
            <tr>
                <td><?= $this->Number->format($migrationsParameter->id) ?></td>
                <td><?= $migrationsParameter->has('migration') ? $this->Html->link($migrationsParameter->migration->name, ['controller' => 'Migrations', 'action' => 'view', $migrationsParameter->migration->id]) : '' ?></td>
                <td><?= $this->Number->format($migrationsParameter->task_id) ?></td>
                <td><?= $migrationsParameter->has('parameter') ? $this->Html->link($migrationsParameter->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $migrationsParameter->parameter->id]) : '' ?></td>
                <td><?= h($migrationsParameter->value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migrationsParameter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migrationsParameter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migrationsParameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migrationsParameter->id)]) ?>
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
