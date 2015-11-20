<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Migration'), ['action' => 'edit', $migration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Migration'), ['action' => 'delete', $migration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $migration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Migrations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Migration'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="migrations view large-9 medium-8 columns content">
    <h3><?= h($migration->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($migration->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Scenario') ?></th>
            <td><?= $migration->has('scenario') ? $this->Html->link($migration->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $migration->scenario->id]) : '' ?></td>
        </tr>
    </table>
    <div class="related">
        <div class="small-6 columns">
            <h4><?= __('Paramètres liés au scénario') ?></h4>
            <table>
                <thead>
                    <tr>
                        <th>Paramètre</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($migration->scenario->parameters as $parameter): ?>
                <tr>
                    <td><?= $parameter->name ?></td>
                    <td><?= $parameter->_joinData->value ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="small-6 columns">
            <h4><?= __('Paramètres liés aux tâches du scénario') ?></h4>
            <?php foreach($migration->scenario->tasks as $task): ?>
                <h5><?= $task->name ?></h5>
                <table>
                    <thead>
                    <tr>
                        <th>Paramètre</th>
                        <th>Valeur</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($task->parameters as $parameter): ?>
                        <tr>
                            <td><?= $parameter->name ?></td>
                            <td><?= $parameter->_joinData->value ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
            <?= debug($migration->scenario->tasks) ?>
        </div>
    </div>
</div>
