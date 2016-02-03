<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier la tâche'), ['action' => 'edit', $task->id], ['escape' => false]) ?></li>
        <li><?= $this->Form->postLink('<i class="fa fa-trash"></i> '.__('Supprimer la tâche'), ['action' => 'delete', $task->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la tâche "{0}" ?', $task->name), 'escape' => false]) ?> </li>
        <li><?= $this->Html->link('<i class="fa fa-arrow-left"></i> '.__('Liste des tâches'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="tasks view large-9 medium-8 columns content">
    <h3>Tâche "<?= h($task->name) ?>"</h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nom') ?></th>
            <td><?= h($task->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($task->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Fichier .kjb correspondant') ?></th>
            <td><?= h($task->job_path) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Paramètres liés à la tâche') ?></h4>
        <div data-alert class="alert-box secondary">
            <i class="fa fa-info-circle"></i> Pour supprimer la liaison d'un paramètre avec la tâche, vous pouvez <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('modifier la tâche'), ['action' => 'edit', $task->id], ['escape' => false]) ?>.
        </div>
        <?php if (!empty($task->parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Nom') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->parameters as $parameters): ?>
            <tr>
                <td><?= h($parameters->name) ?></td>
                <td><?= h($parameters->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['controller' => 'Parameters', 'action' => 'edit', $parameters->id], ['escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
