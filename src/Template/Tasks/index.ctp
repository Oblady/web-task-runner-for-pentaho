<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Nouvelle tâche'), ['action' => 'add'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="tasks index large-9 medium-8 columns content">
    <h3>Tâches</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', ['Nom']) ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('job_path', ['Chemin du fichier .kjb']) ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= h($task->name) ?></td>
                <td><?= h($task->description) ?></td>
                <td><?= h($task->job_path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i> Voir'), ['action' => 'view', $task->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['action' => 'edit', $task->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer'), ['action' => 'delete', $task->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la tâche "{0}" ?', $task->name), 'escape' => false]) ?>
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
