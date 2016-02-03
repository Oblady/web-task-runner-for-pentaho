<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                '<i class="fa fa-trash"></i> '.__('Supprimer la tâche'),
                ['action' => 'delete', $task->id],
                ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la tâche "{0}" ?', $task->name), 'escape' => false]
            )
        ?></li>
        <li><?= $this->Html->link('<i class="fa fa-arrow-left"></i> '.__('Liste des tâches'), ['action' => 'index'], ['escape' => false]) ?></li>
    </ul>
</nav>
<div class="tasks form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Modifier la tâche "') ?><?= $task->name ?>"</legend>
        <?php
            echo $this->Form->input('name', ['label' => 'Nom']);
            echo $this->Form->input('description');
            echo $this->Form->input('job_path', ['label' => 'Fichier .kjb correspondant']);
            echo $this->Form->input('task_id', ['options' => $tasks, 'empty' => true, 'label' => 'Tâche constituant un prérequis à l\'exécution de cette tâche (le cas échéant)']);
            echo $this->Form->input('parameters._ids', ['options' => $parameters, 'label' => 'Paramètres liés à la tâche']);
            //echo $this->Form->input('scenarios._ids', ['options' => $scenarios]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Modifier la tâche'),['class'=>'button success']) ?>
    <?= $this->Form->end() ?>
</div>
