<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fa fa-trash"></i> '.__('Supprimer le paramètre'),
                ['action' => 'delete', $parameter->id],
                ['confirm' => __('Êtes vous sûr(e) de vouloir suppriler le paramètre "{0}" ?', $parameter->name), 'escape' => false]
            )
        ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Liste des paramètres'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="parameters form large-9 medium-8 columns content">
    <?= $this->Form->create($parameter) ?>
    <fieldset>
        <legend><?= __('Modifier le paramètre "').$parameter->name.'"' ?></legend>
        <?php
            echo $this->Form->input('name',['label'=>'Nom du paramètre']);
            echo $this->Form->input('description',['label'=>'Description du paramètre']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enregistrer le paramètre'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
