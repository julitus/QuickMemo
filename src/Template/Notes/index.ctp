<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Note[]|\Cake\Collection\CollectionInterface $notes
 */
?>
<div class="main_btm" id="qmenu-2"><!-- start main_btm -->
    <div class="container">
        <div class="main row">
            <div class="col-md-8 col-md-offset-2 col-xs-12 ">
                <?= $this->Flash->render() ?>
                <?php if(empty($notes->toArray())): ?>
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Info >> </strong> No results found.
                    </div>
                <?php else: ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Success >> <?= $this->Paginator->counter('{{count}}') ?> </strong> found results.
                    </div>

                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('title', 'Title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('type_id', 'Type') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('keyword', 'Keywords') ?></th>
                                <th scope="col"><i class="fa fa-paperclip"></i></th>
                                <th scope="col"><i class="fa fa-lock"></i></th>
                                <th scope="col"><?= $this->Paginator->sort('hit', '<i class="fa fa-eye"></i>', ['escape' => false]) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('rating', 'Rating') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('created', 'Created') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notes as $note): ?>
                            <tr>
                                <td><?= h($note->title) ?></td>
                                <td><?= $note->has('type') ? h($note->type->name) : '...' ?></td>
                                <td>
                                    <?php $keywords = explode(",", $note->keyword); ?>
                                    <?php foreach ($keywords as $k): ?>
                                        <label><span class="label label-custom">
                                            <?= $k ?>
                                        </span></label>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php if(!is_null($note->file)): ?>
                                        <i class="fa fa-paperclip"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($note->important): ?>
                                        <i class="fa fa-lock"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?= h($note->hit) ?></td>
                                <td>
                                    <?php for ($i = 0; $i < $note->rating; $i++) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } ?>
                                </td>
                                <td><?= h(date("d-m-Y H:i", strtotime($note->created))) ?></td>
                                <td class="actions">
                                    <?php if($note->important): ?>
                                        <a data-toggle="modal" href='#bearout' class="openBearOut btn btn-simbol btn-custom" data-id='<?= $note->id ?>', data-slug='<?= $note->slug ?>'><span class="fa fa-search" aria-hidden="true"></span></a>
                                    <?php else: ?>
                                        <?= $this->Html->link(__('<span class="fa fa-search" aria-hidden="true"></span>'), ['action' => 'view', $note->id, $note->slug], ['class' => 'btn btn-simbol btn-custom', 'title' => 'Ver', 'escape' => false]) ?>
                                    <?php endif; ?>
                                    <a data-toggle="modal" href='#setrating' class="openSetRating btn btn-simbol btn-custom" data-id='<?= $note->id ?>', data-rating='<?= $note->rating ?>'><span class="fa fa-star-o" aria-hidden="true"></span></a>
                                    <?= $this->Form->postLink(__('<span class="fa fa-times" aria-hidden="true"></span>'), ['action' => 'delete', $note->id], ['confirm' => __('¿Estas seguro que quieres eliminar el registro # {0}?', $note->title), 'class'=>'btn btn-simbol btn-custom', 'title' => 'Eliminar', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <ul class="pagination">
                        <?= $this->Paginator->first('&lsaquo;', ['escape' => false]) ?>
                        <?= $this->Paginator->prev('&laquo;', ['escape' => false]) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next('&raquo;', ['escape' => false]) ?>
                        <?= $this->Paginator->last('&rsaquo;', ['escape' => false]) ?>
                    </ul>
                    <p><?= $this->Paginator->counter('Resultados {{start}} - {{end}} de {{count}}, página {{page}} / {{pages}}') ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bearout" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">What's your keyword?</h3>
      </div>
      <div class="modal-body">
        <?= $this->Form->create(null, ['url' => ['controller' => 'notes', 'action' => 'bearout']]) ?>
          <div class="form-group" style="margin: 0 15px 15px 15px;">
            <div class="row">
              <?php
                echo $this->Form->input('id', ['type' => 'hidden', 'id' => 'note-id']);
                echo $this->Form->input('slug', ['type' => 'hidden', 'id' => 'note-slug']);
                echo $this->Form->input('page', ['type' => 'hidden', 'id' => 'note-page']);
                echo $this->Form->input('keyword', ['class' => 'form-control', 'label' => '<span>Keyword <label>*</label></span>', 'id' => 'note-keyword', 'type' => 'password', 'escape' => false]);
              ?>
            </div>
          </div>
              <?= $this->Form->button('Ok', ['class' => 'btn btn-custom']); ?>
              <button type="button" class="btn btn-custom" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="setrating" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Change rating</h3>
      </div>
      <div class="modal-body">
        <?= $this->Form->create(null, ['url' => ['controller' => 'notes', 'action' => 'setrating']]) ?>
          <div class="form-group" style="margin: 0 15px 15px 15px;">
            <div class="row">
              <?php
                echo $this->Form->input('id', ['type' => 'hidden', 'id' => 'not-id']);
                echo $this->Form->input('page', ['type' => 'hidden', 'id' => 'not-page']);
                echo $this->Form->input('rating', ['id' => 'not-rating', 'type' => 'hidden']);
              ?>
              <div class="input number">
                <label for="not-rating"><span>Rating <label>*</label></span></label>
                <div id="modal-rating"></div>
              </div>
            </div>
          </div>
              <?= $this->Form->button('Ok', ['class' => 'btn btn-custom']); ?>
              <button type="button" class="btn btn-custom" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>