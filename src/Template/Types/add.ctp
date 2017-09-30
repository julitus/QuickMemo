<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="main_btm" id="qmenu-1"><!-- start main_btm -->
    <div class="container">
        <div class="main row">
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <div class="contact-form">
                    <h2>New Type</h2>
                    <?= $this->Form->create($type) ?>
                        <div>
                            <span>name <label>*</label></span>
                            <span>
                                <?= $this->Form->input('name', ['label' => false, 'class' => 'form-control', "autofocus" => "autofocus"]) ?>
                            </span>
                        </div>
                        <div>
                            <label class="fa-btn btn-1 btn-1e">
                                <input type="submit" value="save">
                            </label>
                            <div class="content_right">
                                <?= $this->Html->link('Back', ['controller' => 'notes', 'action' => 'add'], ['class' => 'fa-btn btn-1 btn-1e']) ?>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <?= $this->Flash->render() ?>
                <?php if(empty($types->toArray())): ?>
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Info >> </strong> No results found.
                    </div>
                <?php else: ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Success >> <?= $this->Paginator->counter('{{count}}') ?> </strong> found results.
                    </div>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>        
        </div> 
    </div>
    <div class="container">
        <div class="results row">
            <div class="col-md-8 col-md-offset-2 col-xs-12 ">
                <?php if(!empty($types->toArray())): ?>
                    <table class='table table-striped'>
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('name', 'Name') ?></th>
                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($types as $typ): ?>
                            <tr>
                                <td><?= h($typ->name) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<span class="fa fa-pencil" aria-hidden="true"></span>'), ['action' => 'edit', $typ->id], ['class'=>'btn btn-simbol btn-custom', 'title' => 'Editar', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('<span class="fa fa-times" aria-hidden="true"></span>'), ['action' => 'delete', $typ->id], ['confirm' => __('¿Estas seguro que quieres eliminar el registro # {0}?', $typ->name), 'class'=>'btn btn-simbol btn-custom', 'title' => 'Eliminar', 'escape' => false]) ?>
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