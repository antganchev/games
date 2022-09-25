<div class="container">
    <h1 class="text-center">Create a Game</h1>
    <hr />
    <a href="/" class="btn btn-primary float-end">Back to games list</a>
    <div class="clearfix"></div>
    <form id="<?=$form->getFormName()?>" class="mt-5" method="POST" enctype="multipart/form-data">
        <?php if (!empty($form->successMessage) || !empty($form->errorMessage)) { ?>
            <div class="alert alert-<?=!empty($form->successMessage) ? 'success' : 'danger'?>">
                <?=!empty($form->successMessage) ? $form->successMessage : $form->errorMessage?>
            </div>
        <?php } ?>  
        <div class="row">
            <div class="col-12">
                <b>State</b>
                <div class="mb-3 state-selector">
                    <?=$form->get("state")->renderRadioGroup()?>
                </div>
            </div>
            <div class="col-6">
                <?=$form->get("name")->renderDecorated()?>
            </div>
            <div class="col-6">
                <?=$form->get("picture")->renderFileInput()?>
            </div>
        </div>
        <button class="btn btn-success float-end">Create</button>
    </form>
</div>