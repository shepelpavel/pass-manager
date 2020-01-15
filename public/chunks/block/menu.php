<div class="menu js-menu">
    <div class="button menu-trigger js-menu-trigger">
        <span class="menu-trigger_line menu-trigger_line1"></span>
        <span class="menu-trigger_line menu-trigger_line2"></span>
    </div>
    <div class="menu__inner">
        <div class="button menu__inner_link js-add-group">
            Добавить каталог
        </div>
        <div class="button menu__inner_link js-add-pass">
            Добавить пароль
        </div>
        <div>
            <input class="js-generate-length" type="number" name="length" value="12" min="4" max="40">
        </div>
        <div>
            <input class="js-generate-num" type="checkbox" name="num" checked>
            <div>
                Цифры
            </div>
        </div>
        <div>
            <input class="js-generate-sym" type="checkbox" name="sym" checked>
            <div>
                Спецсимволы
            </div>
        </div>
        <div class="button menu__inner_link js-generate-button">
            Сгенерировать
        </div>
        <div>
            <pre class="js-generate-password">---</pre>
        </div>
        <!-- <div class="button menu__inner_link js-change-key">
            Изменить ключ
        </div> -->
    </div>
</div>