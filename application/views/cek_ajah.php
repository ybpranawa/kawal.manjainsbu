<html>
halooo
<table border='1'>
<?php
$todate = date('d');
echo "<th></th>";
for($x = 1; $x<=$todate; $x++)
{
    if($x<10)
        $tgl = date('Y-m'). "-0".$x;
    else $tgl = date('Y-m'). "-0".$x;
    echo "<th>".$x."</th>";
}
$count_array = count($count);
for($y = 0; $y<$count_array;$y++)
{
   echo"<tr>";
   echo "<td>".$tek[$y]."</td>";
   for($x = 1; $x<=$todate; $x++)
    {
        if($x<10)
            $tgl = date('Y-m'). "-0".$x;
        else $tgl = date('Y-m'). "-0".$x;

        
        foreach($count[$y] as $in)
        {
            if($in->tanngal == $tgl)
            {
                echo "<td>".$in->jum."</td>";
            }

        }
    }
   
   echo"</tr>";
}

?>
</table>
</html>