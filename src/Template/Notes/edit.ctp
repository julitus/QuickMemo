<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?= $this->Html->script('tinymce.min.js') ?>
  <script>
   tinymce.init({ selector:'.edittextarea', height: 300,  plugins: [
    'advlist autolink lists link print preview anchor',
    'visualblocks code fullscreen',
    'insertdatetime table contextmenu paste code'
   ], });
 </script>

<div class="main_btm" id="qmenu-1"><!-- start main_btm -->
    <div class="container">
        <div class="main row">
            <div class="col-md-8 col-md-offset-2 col-xs-12">
                <?= $this->Flash->render() ?>
                <div class="contact-form">
                    <h2>New Note</h2>
                    <?= $this->Form->create($note, ['type' => 'file']) ?>
                        <div>
                            <span>type</span>
                            <span>
                                <div class="select-sec">
                                    <?= $this->Form->input('type_id', ['options' => $types, 'empty' => '-- Select Type --', 'label' => false, 'class' => 'form-control', "autofocus" => "autofocus"]) ?>
                                </div>
                                <div class="select-btn">
                                    <div class="content_right content_right_clean">
                                        <?= $this->Html->link('new type', ['controller' => 'types', 'action' => 'add'], ['class' => 'fa-btn btn-1 btn-1e', 'escape' => false]) ?>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div>
                            <span>title <label>*</label></span>
                            <span>
                                <?= $this->Form->input('title', ['label' => false, 'class' => 'form-control'/*, "autofocus" => "autofocus", "onFocus" => "this.select()"*/]) ?>
                            </span>
                        </div>
                        <div>
                            <span>description</span>
                            <span>
                                <?= $this->Form->input('content', ['type' => 'textarea', 'class' => 'edittextarea form-control', 'label' => false]); ?>
                            </span>
                        </div>
                        <div>
                            <span>keywords <label>*</label></span>
                            <span>
                                <?= $this->Form->input('keyword', ['label' => false, 'class' => 'form-control', 'data-role' => 'tagsinput']) ?>
                            </span>
                        </div>
                        <div>
                            <span>image</span>
                            <span>
                                <div class="image-sec">
                                    <?= $this->Form->input('imagen', ['label' => false, 'class' => 'form-control input-file', 'type' => 'file', 'accept' => 'image/*', 'id' => 'photoImage', 'onchange' => "readFile('photoImage', 'imgPhoto');"]) ?>
                                </div>
                                <div class="image-load">
                                    <?php if($note['file'] == "" or is_null($note['file'])): ?>
                                      <?= $this->Html->image('no-image.png', ['alt' => 'imagen', 'id' => 'imgPhoto']) ?>
                                    <?php else: ?>
                                      <?= $this->Html->image('/'. $note['path'] . $note['file'], ['alt' => 'imagen', 'id' => 'imgPhoto']) ?>
                                    <?php endif; ?>
                                </div>
                            </span>
                        </div>
                        <div>
                            <span>
                                Private? 
                                <?= $this->Form->checkbox('important', ['value' => true, 'class' => 'checkbox-custom']) ?>
                            </span>
                        </div>
                        <div>
                            <label class="fa-btn btn-1 btn-1e">
                                <input type="submit" value="save">
                            </label>
                            <div class="content_right">
                                <a href="javascript:history.back()" class="fa-btn btn-1 btn-1e">cancel</a>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>      
            <div class="clearfix"></div>        
        </div> 
    </div>
</div>