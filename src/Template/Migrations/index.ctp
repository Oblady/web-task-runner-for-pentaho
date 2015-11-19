<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Migration'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="migrations index large-9 medium-8 columns content">
    <h3><?= __('Migrations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('scenario_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migrations as $migration): ?>
            <tr>
                <td><?= $this->Number->format($migration->id) ?></td>
                <td><?= h($migration->name) ?></td>
                <td><?= $migration->has('scenario') ? $this->Html->link($migration->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $migration->scenario->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $migration->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $migration->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $migration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migration->id)]) ?>
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
