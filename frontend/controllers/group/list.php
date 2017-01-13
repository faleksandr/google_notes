<input type="checkbox" name="Notes[visibility]" checked value="1"> Всем<br>
<input type="checkbox" name="Notes[visibility]" checked value="2"> Только мне<br>
<?php
foreach ($rbac as $role){?>
    <input type="checkbox" name="Notes[visibility]" checked value="<?=$role['id'];?>"> Группе: <?=$role['name'];?>
    <br>
<?}?>
