<?php
/**
 * Created by PhpStorm.
 * User: Severin
 * Date: 10.01.2018
 * Time: 11:12
 */
function showTable($stmt)
{
    // 1. Anzahl der Attribute ermitteln
    $countAttribut = $stmt->columnCount();
    // 2. leeres Array erstellen
    $attribute= array();
    // 3. Attributeigenschaften in das Array "schreiben"


    for ($i=0;$i < $countAttribut; $i++)
    {
        $attribute[$i]=$stmt->getColumnMeta($i);
    }
    echo '<table border="1">
          <tr>';
    foreach ($attribute as $a)
    {
        echo'<th>';
        echo $a['name'];
        echo'</th>';
    }
    echo '</tr>';
    while($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>';
            echo $r.' ';
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '<table>';
}
