<?php if (count($data) > 0 ): ?>
<table>
    <tr>
        <?php foreach($data[0] as $key => $value): ?>
        <th><?= $key ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($data as $item): ?>
        <tr>
            <?php foreach ($item as $value): ?>
            <td><?= $value ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<?php 
    //echo "<pre>";print_r($data);echo "</pre>";
    //echo "<a href=".site_url('dashboard').">Back</a>";
?>