<h2 class="js-title" this-path="<?= $_POST['path'] ?>" this-fullpath="<?= $_POST['fullpath'] ?>">Add pass</h2>
<p class="link js-tree-path" target="/">ГЛАВНАЯ</p>
<p class="link js-tree-path" target="<?= $_POST['path'] ?>">Назад</p>
<input class="js-input-title" type="text" name="title" value="">
<br>
<input class="js-input-link js-crypt" type="text" name="link" value="">
<br>
<input class="js-input-login js-crypt" type="text" name="login" value="">
<br>
<input class="js-input-pass js-crypt" type="text" name="pass" value="">
<br>
<textarea class="js-input-note js-crypt" name="note" rows="8" cols="80"></textarea>

<div class="link js-newpass-save">Сохранить</div>
<div class="link js-tree-path" target="<?= $_POST['path'] ?>">Отмена</div>