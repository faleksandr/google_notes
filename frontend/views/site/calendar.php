<?php
$this->title = 'Календарь';
?>
<? if ($url && strlen($url) > 50) { ?>
    <iframe src="<?= $url; ?>" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
<? } else { ?>
    <div class="need_link">Для начала установите google calendar id.</div>
<? } ?>

