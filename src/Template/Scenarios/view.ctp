<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Modifier le scénario'), ['action' => 'edit', $scenario->id], ['escape' => false]) ?> </li>
        <li><?= $this->Form->postLink('<i class="fa fa-trash"></i> '.__('Supprimer le scenario'), ['action' => 'delete', $scenario->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer le scénario "{0}" ?', $scenario->name), 'escape' => false]) ?> </li>
        <li><?= $this->Html->link('<i class="fa fa-arrow-left"></i> '.__('Liste des scénarios'), ['action' => 'index'], ['escape' => false]) ?> </li>
    </ul>
</nav>
<div class="scenarios view large-9 medium-8 columns content">
    <h3><?= h($scenario->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nom') ?></th>
            <td><?= h($scenario->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($scenario->description) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Paramètres liés au scénario') ?></h4>
        <div data-alert class="alert-box secondary">
            <i class="fa fa-info-circle"></i> Pour supprimer la liaison d'un paramètre avec le scénario, vous pouvez <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('modifier le scénario'), ['action' => 'edit', $scenario->id], ['escape' => false]) ?>.
        </div>
        <?php if (!empty($scenario->parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($scenario->parameters as $parameters): ?>
            <tr>
                <td><?= h($parameters->name) ?></td>
                <td><?= h($parameters->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['controller' => 'Parameters', 'action' => 'edit', $parameters->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Tâches liées au scénario') ?></h4>
        <div data-alert class="alert-box secondary">
            <i class="fa fa-info-circle"></i> Pour supprimer la liaison d'une tâche avec le scénario, vous pouvez <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('modifier le scénario'), ['action' => 'edit', $scenario->id], ['escape' => false]) ?>.
        </div>
        <?php if (!empty($scenario->tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Nom') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Fichier .kjb correspondant') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($scenario->tasks as $tasks): ?>
            <tr>
                <td><?= h($tasks->name) ?></td>
                <td><?= h($tasks->description) ?></td>
                <td><?= h($tasks->job_path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i> Voir'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id],['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
