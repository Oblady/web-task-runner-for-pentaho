<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-pencil"></i> Modifier cette migration'), ['action' => 'edit', $migration->id], ['escape' => false]) ?> </li>
        <li><?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Supprimer cette migration'), ['action' => 'delete', $migration->id], ['confirm' => __('Êtes vous sûr(e) de vouloir supprimer la migration "{0}"?', $migration->name), 'escape' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Liste des migrations'), ['action' => 'index'], ['escape' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Nouvelle migration'), ['action' => 'add'], ['escape' => false]) ?> </li>
    </ul>
</nav>
<div class="migrations view large-9 medium-8 columns content">
    <h3>Migration "<?= h($migration->name) ?>"</h3>
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
                            <a href="#exec_kitchen_<?= $task->id ?>" class="button tiny secondary" title="Révéler la commande Kitchen"><i class="fa fa-terminal"></i></a>
                            <?= $this->Html->link('<i class="fa fa-flag-checkered"></i>&nbsp;&nbsp;&nbsp;Lancer', ['action' => 'requirements', $migration->id, $task->id], ['class' => 'button tiny success', 'escape' => false]) ?>
                            <!--<?= $this->Form->postLink('<i class="fa fa-stop"></i> &nbsp;&nbsp;&nbsp;Stopper l\'exécution', ['action' => 'delete', $execLines[$task->id]], ['confirm' => __('Exécuter {0} ?', $execLines[$task->id]), 'class' => 'button tiny alert', 'escape' => false]) ?>-->
                            <?php if(file_exists(LOGS.'kitchen/'.$migration->id.'_'.$task->id.'.log')): ?>
                            <?= $this->Html->link('<i class="fa fa-file-text-o"></i> &nbsp;&nbsp;&nbsp;Voir la trace', ['action' => 'view-log', $migration->id, $task->id], ['class' => 'button tiny', 'escape' => false]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <section class="modal--show" id="exec_kitchen_<?= $task->id ?>" tabindex="-1"
                             role="dialog" aria-labelledby="modal-label" aria-hidden="true">

                        <div class="modal-inner">
                            <header id="modal-label">Commande Kitchen.sh</header>
                            <div class="modal-content">
                                <a href='javascript:copyTextToClipboard(document.getElementById("command<?=$task->id?>").innerText); document.getElementById("close<?=$task->id?>").click()' class='button secondary'><i class="fa fa-clipboard"></i> Copier la commande dans le presse-papier</a>
                                <div id="command<?=$task->id?>" style="font-family: monospace; margin-top:20px; margin-bottom: 10px;"><?=$execLines[$task->id]?></div>
                            </div>
                        </div>

                        <a id="close<?=$task->id?>" href="#!" class="modal-close" title="Close this modal" data-close="Close"
                           data-dismiss="modal">?</a>
                    </section>
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
                    <td><span style="cursor:help; border-bottom: 1px dotted;" title="<?= $parameter->description ?>"><?= $parameter->name ?></span>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil"></i> '.$parameter->_joinData->value,
                            [
                                'controller' => 'ParametersScenarios',
                                'action' => 'edit',
                                $parameter->_joinData['id'],
                                'redir_controller' => 'migrations',
                                'redir_action' => 'view',
                                'redir_param1' => $migration->id
                            ],
                            ['escape' => false]
                        ); ?>
                        </td>
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
                            </td>
                            <td>
                                <?php if(isset($migrationsParameters[$task->id][$parameter->id])): ?>
                                    <?= $this->Html->link(
                                        isset($migrationsParameters[$task->id][$parameter->id]) ? '<i class="fa fa-pencil"></i> '.$migrationsParameters[$task->id][$parameter->id] : '<i class="fa fa-pencil"></i> <em style="color:#cacaca;">non défini</em>',
                                        [
                                            'controller' => 'MigrationsParameters',
                                            'action' => 'edit',
                                            $migrationsParametersId[$task->id][$parameter->id]
                                        ],
                                        ['escape' => false]
                                    ); ?>
                                <?php else: ?>
                                    <?= $this->Html->link(
                                        isset($migrationsParameters[$task->id][$parameter->id]) ? '<i class="fa fa-pencil"></i> '.$migrationsParameters[$task->id][$parameter->id] : '<i class="fa fa-pencil"></i> <em style="color:#cacaca;">non défini</em>',
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
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript">
    function copyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        //
        // *** This styling is an extra step which is likely not required. ***
        //
        // Why is it here? To ensure:
        // 1. the element is able to have focus and selection.
        // 2. if element was to flash render it has minimal visual impact.
        // 3. less flakyness with selection and copying which **might** occur if
        //    the textarea element is not visible.
        //
        // The likelihood is the element won't even render, not even a flash,
        // so some of these are just precautions. However in IE the element
        // is visible whilst the popup box asking the user for permission for
        // the web page to copy to the clipboard.
        //
        // Place in top-left corner of screen regardless of scroll position.
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;
        // Ensure it has a small width and height. Setting to 1px / 1em
        // doesn't work as this gives a negative w/h on some browsers.
        textArea.style.width = '2em';
        textArea.style.height = '2em';
        // We don't need padding, reducing the size if it does flash render.
        textArea.style.padding = 0;
        // Clean up any borders.
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';
        // Avoid flash of white box if rendered for any reason.
        textArea.style.background = 'transparent';
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
            var success = document.createElement('div');
            success.setAttribute("class","message success");
            success.setAttribute("onclick","this.classList.add('hidden')");
            success.innerText = "Commande copiée dans le presse-papier";
            document.body.appendChild(success);
        } catch (err) {
            alert('Votre navigateur ne supporte pas la fonctionnalité de copier/coller. Merci de mettre à jour votre navigateur.');
        }
        document.body.removeChild(textArea);
    }
</script>
<?php $this->end(); ?>