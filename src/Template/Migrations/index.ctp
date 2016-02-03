<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Nouvelle migration'), ['action' => 'add'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="migrations index large-9 medium-8 columns content">
    <h3><?= __('Migrations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', 'Nom') ?></th>
                <th><?= $this->Paginator->sort('scenario_id', 'Scénario lié') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($migrations as $migration): ?>
            <tr>
                <td><?= h($migration->name) ?></td>
                <td><?= $migration->has('scenario') ? $this->Html->link($migration->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $migration->scenario->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i> Voir'), ['action' => 'view', $migration->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['action' => 'edit', $migration->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer'), ['action' => 'delete', $migration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migration->id), 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('précédent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
