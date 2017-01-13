<?php
$this->title = 'Профиль';
?>

<style>
    .events_title {
        padding: 15px 10px;
        color: #000;
        font-size: 20px;
    }

    .events_list {
        color: green;
        padding: 10px;
    }
</style>

<div class="events_title">Последние события</div>
<div class="events_list">
    <?php
    foreach ($event as $events) {
        echo '(' . date("d.m H:i",$events['date']) . ') ' . $events['name'] . ' ' . $events["text"] . '<br>';
    }
    ?>
</div>
