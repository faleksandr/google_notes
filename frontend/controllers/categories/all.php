<div style="margin-bottom:10px;">
    <input type="checkbox" name="Notes[cat]" value="<?= $category['id']; ?>"> <?= $category['name'] ?>
</div>
<?php if (isset($category['childs'])): ?>
    <div style="margin-left:30px;">
        <?= $this->getList($category['childs']) ?>
    </div>
<?php endif; ?>