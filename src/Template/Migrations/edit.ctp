<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fa fa-trash"></i> '.__('Supprimer la migration'),
                ['action' => 'delete', $migration->id],
                ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la migration "{0}" ?', $migration->name), 'escape' => false]
            )
        ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Liste des migrations'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="migrations form large-9 medium-8 columns content">
    <?= $this->Form->create($migration) ?>
    <fieldset>
        <legend><?= __('Modifier la migration "').$migration->name ?>"</legend>
        <?php
            echo $this->Form->input('name',['label' => 'Nom']);
            echo $this->Form->input('scenario_id', ['options' => $scenarios, 'empty' => true, 'label' => 'Basée sur le scénario']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier la migration'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
