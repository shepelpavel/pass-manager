<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/html/header.php'; ?>

<div class="notes">
    <section class="notes__left">
        <div class="notes__left_controls">
            <div class="btn notes__left_controls_btn js-add-note">
                + note
            </div>
            <div class="btn notes__left_controls_btn js-add-group">
                + group
            </div>
        </div>
        <div class="notes__left_list">
            
        </div>
    </section>
    <section class="notes__workflow js-workflow">
        <div class="notes__workflow_edit">
            <textarea class="notes__workflow_edit_textarea js-textarea" name="note" rows="8" cols="80"></textarea>
            <div class="btn notes__workflow_edit_btn js-save">
                save
            </div>
        </div>
    </section>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/html/footer.php'; ?>
