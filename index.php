<?php

echo '<p>Hello fmi. Get ready to hack.</p>';

echo '<p>Pssst.. any fmi ideas go <a href="https://fss.fmi.uni-sofia.bg/za-nas/kutiq-za-idei/" target="_blank">here</a></p>';


echo '<table border="1"><tr>';
for ($x = 1; $x <= 9; $x++) {
    echo "<th>$x</th>";
}

echo '</tr>';

for ($x = 2; $x <= 9; $x++) {
    echo '<tr>';
    for ($y = 1; $y <= 9; $y++) {
        $z=$x*$y;
        if($y==1)
            echo "<th>$z</th>";
        else
            echo "<td>$z</td>";
    }
    echo '</tr>';
}


  echo '</table>';


?>
