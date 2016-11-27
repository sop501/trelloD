<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Team Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teamMembers index large-9 medium-8 columns content">
    <h3><?= __('Team Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assigned') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teamMembers as $teamMember): ?>
            <tr>
                <td><?= $this->Number->format($teamMember->id) ?></td>
                <td><?= $teamMember->has('user') ? $this->Html->link($teamMember->user->name, ['controller' => 'Users', 'action' => 'view', $teamMember->user->id]) : '' ?></td>
                <td><?= $teamMember->has('team') ? $this->Html->link($teamMember->team->name, ['controller' => 'Teams', 'action' => 'view', $teamMember->team->id]) : '' ?></td>
                <td><?= h($teamMember->assigned) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teamMember->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teamMember->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teamMember->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamMember->user_id)]) ?>
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
