<?php
use app\dto\ExplainDTO;

/* @var $explainData ExplainDTO[] */
?>

<table class="table table-striped">
    <tr>
        <th>ID</th>
        <th>select_type</th>
        <th>table</th>
        <th>partitions</th>
        <th>type</th>
        <th>possible_keys</th>
        <th>key</th>
        <th>key_len</th>
        <th>ref</th>
        <th>rows</th>
        <th>filtered</th>
        <th>Extra</th>
    </tr>
    <?php foreach ($explainData as $item) { ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->select_type ?></td>
            <td><?= $item->table ?></td>
            <td><?= $item->partitions ?></td>
            <td><?= $item->type ?></td>
            <td><?= $item->possible_keys ?></td>
            <td><?= $item->key ?></td>
            <td><?= $item->key_len ?></td>
            <td><?= $item->ref ?></td>
            <td><?= $item->rows ?></td>
            <td><?= $item->filtered ?></td>
            <td><?= $item->Extra ?></td>
        </tr>
    <?php } ?>
</table>