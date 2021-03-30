<?php

require_once "database/DatabaseInterface.php";
require_once "database/Database.php";
require_once "database/Currency.php";

$currency = new \Database\Currency();

?>

<html>
    <table border="1">
        <th>ValuteID</th>
        <th>Code Num</th>
        <th>Code Char</th>
        <th>Name</th>
        <th>Value</th>
        <th>Date</th>
        <tbody>
            <?php foreach ($currency->all() as $currence): ?>
            <tr>
                <td><?= $currence['valuteID'] ?></td>
                <td><?= $currence['codeNum'] ?></td>
                <td><?= $currence['codeChar'] ?></td>
                <td><?= $currence['name'] ?></td>
                <td><?= $currence['value'] ?></td>
                <td><?= $currence['date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</html>
