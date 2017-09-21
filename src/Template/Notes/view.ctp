<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note $note
 */
?>
<div class="main_btm" id="qmenu-1"><!-- start main_btm -->
    <div class="container">
        <div class="main row">
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <div class="row">
                    <div class="col-md-9 col-xs-12">
                        <h3 class="title-header-note">
                            <?= h($note->title) ?>
                            <label class="type-tag"><?= $note->has('type') ? h($note->type->name) : '...' ?></label>
                        </h3>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="stats-note">
                            <i><?= $this->Number->format($note->hit) ?> visualizations</i><br>
                            <?php for ($i = 0; $i < $note->rating; $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Keyword') ?></th>
                        <td>
                            <?php $keywords = explode(",", $note->keyword); ?>
                            <?php foreach ($keywords as $k): ?>
                                <label><span class="label label-custom">
                                    <?= $k ?>
                                </span></label>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <!--tr>
                        <th scope="row"><?= __('Hit') ?></th>
                        <td><?= $this->Number->format($note->hit) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Rating') ?></th>
                        <td><?= $this->Number->format($note->rating) ?></td>
                    </tr-->
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h(date("d-m-Y H:i", strtotime($note->created))) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h(date("d-m-Y H:i", strtotime($note->modified))) ?></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-xs-12">
                        <h5><?= __('Description') ?></h5>
                        <div class="description-view">
                            <?= $note->content ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 buttons-view">
                        <div class="content_right r-left">
                            <?= $this->Html->link('edit', ['action' => 'edit', $note->id, $note->slug], ['class' => 'fa-btn btn-1 btn-1e', 'escape' => false]) ?>
                        </div>
                        <div class="content_right">
                            <a href="javascript:history.back()" class="fa-btn btn-1 btn-1e">back</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <!--h5><?= __('Image') ?></h5-->
                        <div class="image-view">
                            <?php if(is_null($note->file)): ?>
                                no image included
                            <?php else: ?>
                                <?= $this->Html->image('/' . $note->path . $note->file) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>