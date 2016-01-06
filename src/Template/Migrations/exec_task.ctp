<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-pencil"></i> Modifier cette migration'), ['action' => 'edit', $migration->id], ['escape' => false]) ?> </li>
        <li><?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer cette migration'), ['action' => 'delete', $migration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migration->id), 'escape' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="fa fa-list"></i> Lister les migrations'), ['action' => 'index'], ['escape' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Nouvelle migration'), ['action' => 'add'], ['escape' => false]) ?> </li>
    </ul>
</nav>
<div class="migrations view large-9 medium-8 columns content">
    <h3>Exécution de la tâche <?= h($migration->tasks) ?> <?= h($migration->name) ?></h3>
    <h4><?= __('Tâches du scénario associé à la migration') ?></h4>
</div>