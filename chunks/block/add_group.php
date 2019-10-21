<div class="modal modal-add-group js-add-group-modal">
	<div class="modal__close js-modal-close">X</div>
	<div>Path: <?= $_SESSION['folder']['name'] ?></div>
	<input type="hidden" name="path" value="<?= $_SESSION['folder']['name'] ?>">
	<input type="text" name="title" value="">
	<div class="btn js-add-group">Add Group</div>
</div>