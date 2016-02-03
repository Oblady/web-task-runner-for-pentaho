<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link('<i class="fa fa-arrow-left"></i> '.__('Liste des paramètres'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="parameters form large-9 medium-8 columns content">
    <?= $this->Form->create($parameter) ?>
    <fieldset>
        <legend><?= __('Ajouter un paramètre') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'Nom du paramètre']);
            echo $this->Form->input('description', ['label' => 'Description du paramètre']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Créer le paramètre'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
