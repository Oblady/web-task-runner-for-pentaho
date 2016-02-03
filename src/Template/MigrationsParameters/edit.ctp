<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <!--<li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $migrationsParameter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $migrationsParameter->id)]
            )
        ?></li>-->
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Retour à la migration'), ['controller' => 'migrations', 'action' => 'view', $migrationsParameter->migration->id], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="migrationsParameters form large-9 medium-8 columns content">
    <?= $this->Form->create($migrationsParameter) ?>
    <fieldset>
        <legend>Éditer la valeur du paramètre <code>${<?= $migrationsParameter->parameter->name ?>}</code> pour la migration <em><?= $migrationsParameter->migration->name ?></em></legend>
        <?php
            echo $this->Form->input('value', ['label' => 'Valeur du paramètre', 'autofocus']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enregistrer le paramètre')) ?>
    <?= $this->Form->end() ?>
</div>