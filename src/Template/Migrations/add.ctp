<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Liste des migrations'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="migrations form large-9 medium-8 columns content">
    <?= $this->Form->create($migration) ?>
    <fieldset>
        <legend><?= __('Ajouter une migration') ?></legend>
        <?php
            echo $this->Form->input('name',['label'=>'Nom']);
            echo $this->Form->input('scenario_id', ['label'=>'Basée sur le scénario', 'options' => $scenarios, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Créer cette migration'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
