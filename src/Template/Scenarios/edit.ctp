<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= ''.$this->Form->postLink(
                __('<i class="fa fa-trash"></i> Supprimer le scénario'),
                ['action' => 'delete', $scenario->id],
                ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer le scénario "{0}" ?', $scenario->name), 'escape' => false]
            )
        ?></li>
        <li><?= $this->Html->link('<i class="fa fa-arrow-left"></i> '.__('Liste des scénarios'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="scenarios form large-9 medium-8 columns content">
    <?= $this->Form->create($scenario) ?>
    <fieldset>
        <legend><?= __('Modifier le scénario "').$scenario->name ?>"</legend>
        <?php
            echo $this->Form->input('name',['label'=>'Nom']);
            echo $this->Form->input('description');
            echo $this->Form->input('parameters._ids', ['options' => $parameters, 'label'=>'Paramètres liés au scénario']);
            echo $this->Form->input('tasks._ids', ['options' => $tasks, 'label'=>'Tâches liées au scénario']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier le scénario'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
