<h1>Словарь нигдейских языков</h1>

<div>
    <form id="translation-form" method="post">
        <div>
            <h3>Направление перевода:</h3>
            <select id="translation-from">
                <?php foreach ($this->languages as $language): ?>
                    <?php $name_original = ($language->name_original && $language->name_original != 'русский') ? ' (' . $language->name_original . ')' : '' ?>
                    <option id="<?php echo $language->id; ?>"><?php echo $language->name_ru . $name_original ?></option>
                <?php endforeach; ?>
            </select>
            <select id="translation-to">
                <?php foreach ($this->languages as $language): ?>
                    <?php $name_original = ($language->name_original && $language->name_original != 'русский') ? ' (' . $language->name_original . ')' : '' ?>
                    <option id="<?php echo $language->id; ?>"><?php echo $language->name_ru . $name_original ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="padding-top: 20px;">
            <h3>Введите слово:</h3>
            <input id="word" type="text" name="word">
            <input type="submit" value="Перевести">
        </div>
    </form>
    <div id="translation"></div>
</div>