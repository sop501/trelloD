<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Board'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('New Task'), ['controller' => 'Tasks', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Tasks'), ['controller' => 'Tasks', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Boards'), ['controller' => 'Boards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="boards index large-9 medium-8 columns content">
    <h3><?= __('Boards') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('completed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boards as $board): ?>
            <tr>
                <td><?= $this->Number->format($board->id) ?></td>
                <td><?= $board->has('team') ? $this->Html->link($board->team->name, ['controller' => 'Teams', 'action' => 'view', $board->team->id]) : '' ?></td>
                <td><?= h($board->title) ?></td>
                <td><?= $board->completed ? __('Yes') : __('No'); ?></td>
                <td><?= h($board->created) ?></td>
                <td><?= h($board->modified) ?></td>
                <td class="actions">
					<?= $this->Html->link(__('Completed'), ['action' => 'complete', $board->id]) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $board->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $board->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $board->id], ['confirm' => __('Are you sure you want to delete # {0}?', $board->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
