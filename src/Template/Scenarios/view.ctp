<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Scenario'), ['action' => 'edit', $scenario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Scenario'), ['action' => 'delete', $scenario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scenario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="scenarios view large-9 medium-8 columns content">
    <h3><?= h($scenario->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($scenario->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($scenario->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($scenario->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Parameters') ?></h4>
        <?php if (!empty($scenario->parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($scenario->parameters as $parameters): ?>
            <tr>
                <td><?= h($parameters->id) ?></td>
                <td><?= h($parameters->name) ?></td>
                <td><?= h($parameters->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Parameters', 'action' => 'view', $parameters->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Parameters', 'action' => 'edit', $parameters->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Parameters', 'action' => 'delete', $parameters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameters->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tasks') ?></h4>
        <?php if (!empty($scenario->tasks)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Job Path') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($scenario->tasks as $tasks): ?>
            <tr>
                <td><?= h($tasks->id) ?></td>
                <td><?= h($tasks->name) ?></td>
                <td><?= h($tasks->description) ?></td>
                <td><?= h($tasks->job_path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tasks', 'action' => 'view', $tasks->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tasks', 'action' => 'edit', $tasks->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tasks', 'action' => 'delete', $tasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tasks->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
