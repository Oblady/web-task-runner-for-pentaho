<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Migrations Parameter'), ['action' => 'edit', $migrationsParameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Migrations Parameter'), ['action' => 'delete', $migrationsParameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migrationsParameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Migrations Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migrations Parameter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Migrations'), ['controller' => 'Migrations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migration'), ['controller' => 'Migrations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="migrationsParameters view large-9 medium-8 columns content">
    <h3><?= h($migrationsParameter->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Migration') ?></th>
            <td><?= $migrationsParameter->has('migration') ? $this->Html->link($migrationsParameter->migration->name, ['controller' => 'Migrations', 'action' => 'view', $migrationsParameter->migration->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Parameter') ?></th>
            <td><?= $migrationsParameter->has('parameter') ? $this->Html->link($migrationsParameter->parameter->name, ['controller' => 'Parameters', 'action' => 'view', $migrationsParameter->parameter->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($migrationsParameter->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($migrationsParameter->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Task Id') ?></th>
            <td><?= $this->Number->format($migrationsParameter->task_id) ?></td>
        </tr>
    </table>
</div>
