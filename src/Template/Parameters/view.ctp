<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Parameter'), ['action' => 'edit', $parameter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Parameter'), ['action' => 'delete', $parameter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parameter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parameters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parameter'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parameters view large-9 medium-8 columns content">
    <h3><?= h($parameter->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($parameter->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($parameter->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($parameter->id) ?></td>
        </tr>
    </table>
</div>
