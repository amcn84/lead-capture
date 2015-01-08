<?php
header("refresh: 3;");
$array = $fields = array(); $i = 0;
$handle = @fopen("http://www.allenidx.com/leads/leads.csv", "r");
if ($handle) {
    while (($row = fgetcsv($handle, 4096)) !== false) {
        if (empty($fields)) {
            $fields = $row;
            continue;
        }
        foreach ($row as $k=>$value) {
            $array[$i][$k] = $value;
        }
        $i++;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
echo "<table>";
echo "<tr><td>id</td><td>firstName</td><td>lastName</td><td>email</td><td>agentOwner</td><td>disabled</td><td>canLogin</td><td>receiveUpdates</td></tr>";
foreach($array as $row) {
	echo "<tr>";
	foreach($row as $column) {
		echo "<td>".$column."</td>";
	}
	echo "</tr>";
}
echo "</table>";
?>
