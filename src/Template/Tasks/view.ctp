<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Task'), ['action' => 'edit', $task->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Task'), ['action' => 'delete', $task->id], ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Task'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['controller' => 'Parameters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['controller' => 'Parameters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scenarios'), ['controller' => 'Scenarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scenario'), ['controller' => 'Scenarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tasks view large-9 medium-8 columns content">
    <h3><?= h($task->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($task->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($task->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Job Path') ?></th>
            <td><?= h($task->job_path) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($task->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Parameters') ?></h4>
        <?php if (!empty($task->parameters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->parameters as $parameters): ?>
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
        <h4><?= __('Related Scenarios') ?></h4>
        <?php if (!empty($task->scenarios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($task->scenarios as $scenarios): ?>
            <tr>
                <td><?= h($scenarios->id) ?></td>
                <td><?= h($scenarios->name) ?></td>
                <td><?= h($scenarios->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scenarios', 'action' => 'view', $scenarios->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scenarios', 'action' => 'edit', $scenarios->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scenarios', 'action' => 'delete', $scenarios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scenarios->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>
