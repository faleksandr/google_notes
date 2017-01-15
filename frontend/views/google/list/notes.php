
<table class="table" style="margin-top: 20px;">
    <tr>
        <td><?= $mdl['name']; ?></td>
        <td><?= $mdl['text']; ?></td>
        <td><img src="<?= $mdl['img']; ?>" height="200" width="200"></td>
        <td><?= date("d.m.Y : H:i", $mdl['date']); ?></td>
    </tr>
</table>