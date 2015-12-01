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
    <h3>Migration <?= h($migration->name) ?></h3>
    <div class="panel">
        <p>Basé sur le scénario <?= $migration->has('scenario') ? $this->Html->link($migration->scenario->name, ['controller' => 'Scenarios', 'action' => 'view', $migration->scenario->id]) : '' ?>.</p>
    </div>
    <div class="related">
        <div class="small-12 columns">
        <h4><?= __('Tâches du scénario associé à la migration') ?></h4>
            <table>
                <tbody>
                <?php foreach($migration->scenario->tasks as $task): ?>
                    <tr>
                        <td><h5><?= $task->name ?></h5></td>
                        <td>
                            <i class="fa fa-spinner fa-lg fa-pulse" style="color:green;"></i> <?= $this->Form->postLink('<i class="fa fa-play"></i>&nbsp;&nbsp;&nbsp;Démarrer l\'exécution', ['action' => 'delete', $execLines[$task->id]], ['confirm' => __('Exécuter {0} ?', $execLines[$task->id]), 'class' => 'button tiny success', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fa fa-stop"></i> &nbsp;&nbsp;&nbsp;Stopper l\'exécution', ['action' => 'delete', $execLines[$task->id]], ['confirm' => __('Exécuter {0} ?', $execLines[$task->id]), 'class' => 'button tiny alert', 'escape' => false]) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
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
                    <td><span style="cursor:help; border-bottom: 1px dotted;" title="<?= $parameter->description ?>"?><?= $parameter->name ?></span>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil"></i>',
                            [
                                'controller' => 'ParametersScenarios',
                                'action' => 'edit',
                                $parameter->_joinData['id']
                            ],
                            ['escape' => false]
                        ); ?>
                    </td>
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
                            <td>
                                <span style="cursor:help; border-bottom: 1px dotted;" title="<?= $parameter->description ?>"?><?= $parameter->name ?></span>
                                <?php if(isset($migrationsParameters[$task->id][$parameter->id])): ?>
                                    <?= $this->Html->link(
                                        '<i class="fa fa-pencil"></i>',
                                        [
                                            'controller' => 'MigrationsParameters',
                                            'action' => 'edit',
                                            $migrationsParametersId[$task->id][$parameter->id]
                                        ],
                                        ['escape' => false]
                                    ); ?>
                                <?php else: ?>
                                    <?= $this->Html->link(
                                        '<i class="fa fa-pencil"></i>',
                                        [
                                            'controller' => 'MigrationsParameters',
                                            'action' => 'add',
                                            'migration_id' => $migration->id,
                                            'task_id' => $task->id,
                                            'parameter_id' => $parameter->id
                                        ],
                                        ['escape' => false]
                                    ); ?>
                                <?php endif; ?>
                            </td>
                            <td><?= isset($migrationsParameters[$task->id][$parameter->id]) ? $migrationsParameters[$task->id][$parameter->id] : '<em style="color:#cacaca;">non défini</em>' ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>
