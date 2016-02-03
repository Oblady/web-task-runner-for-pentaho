<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Nouveau paramètre'), ['action' => 'add'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="parameters index large-9 medium-8 columns content">
    <h3>Paramètres</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', ['Nom']) ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parameters as $parameter): ?>
            <tr>
                <td><?= h($parameter->name) ?></td>
                <td><?= h($parameter->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Éditer'), ['action' => 'edit', $parameter->id], ['escape' => false]) ?>&nbsp;&nbsp;&nbsp;
                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer'), ['action' => 'delete', $parameter->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer le paramètre "{0}" ?', $parameter->name), 'escape' => false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('précedent')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivant') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
