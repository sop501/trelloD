<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Team Member'), ['action' => 'edit', $teamMember->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Team Member'), ['action' => 'delete', $teamMember->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamMember->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Team Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teamMembers view large-9 medium-8 columns content">
    <h3><?= h($teamMember->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $teamMember->has('user') ? $this->Html->link($teamMember->user->name, ['controller' => 'Users', 'action' => 'view', $teamMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $teamMember->has('team') ? $this->Html->link($teamMember->team->name, ['controller' => 'Teams', 'action' => 'view', $teamMember->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assigned') ?></th>
            <td><?= h($teamMember->assigned) ?></td>
        </tr>
    </table>
</div>
