<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Nouveau scénario'), ['action' => 'add'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="scenarios index large-9 medium-8 columns content">
    <h3>Scénarios</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name',['Nom du scénario']) ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scenarios as $scenario): ?>
            <tr>
                <td><?= h($scenario->name) ?></td>
                <td><?= h($scenario->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-eye"></i> Voir'), ['action' => 'view', $scenario->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['action' => 'edit', $scenario->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer'), ['action' => 'delete', $scenario->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer le scénario "{0}" ?', $scenario->name), 'escape' => false]) ?>
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
