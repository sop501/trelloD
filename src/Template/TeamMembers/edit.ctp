<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $teamMember->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $teamMember->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Team Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teamMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($teamMember) ?>
    <fieldset>
        <legend><?= __('Edit Team Member') ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('assigned', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
