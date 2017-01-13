<table class="table" style="margin-top: 20px;">
    <tr>
        <td><?= $mdl['name']; ?></td>
        <td><?= $mdl['text']; ?></td>
        <td><?= $mdl['img']; ?></td>
        <td><?= date("d.m.Y : H:i", $mdl['date']); ?></td>
    </tr>
</table>