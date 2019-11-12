<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$path = $_POST['path'];

if ($path == 'HOME') {
	$path = '';
}

$folders_res = array_diff(scandir($basepath . $path), array('..', '.'));
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/chunks/block/menu.php'; ?>

<div class="content">

	<div class="tree">
		<?php foreach ($folders_res as $value) { ?>
			<?php if (is_dir($basepath . $path . '/' . $value)) { ?>
			<div class="tree__item tree__item_folder js-tree-item">
				<div class="tree__item_link js-tree-path js-tree-name" target="/<?= $value ?>" type="groups">
					<?= $value ?>
				</div>
				<div class="tree__item_more js-more">
					<div class="more__modal js-more-modal">
						<div class="more__modal_item more__modal_item_edit js-folder-edit">
							<img src="/_assets/img/svg/edit.svg" alt="Edit">
							Изменить
						</div>
						<div class="more__modal_item more__modal_item_del js-tree-del">
							<img src="/_assets/img/svg/trash.svg" alt="Delete">
							Удалить
						</div>
					</div>
					<div class="more__anim js-more-anim"></div>
				</div>
			</div>
			<?php } else { ?>
			<div class="tree__item tree__item_passwd js-tree-item">
				<div class="tree__item_link js-pass-title js-tree-name" target="/<?= $value ?>" type="passwd">
					<?= $value ?>
				</div>
				<div class="tree__item_more js-more">
					<div class="more__modal js-more-modal">
						<div class="more__modal_item more__modal_item_edit js-pass-title js-tree-name"
							target="<?= $value ?>" type="passwd">
							<img src="/_assets/img/svg/edit.svg" alt="Edit">
							Изменить
						</div>
						<div class="more__modal_item more__modal_item_del js-tree-del">
							<img src="/_assets/img/svg/trash.svg" alt="Delete">
							Удалить
						</div>
					</div>
					<div class="more__anim js-more-anim"></div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>

	</div>

</div>