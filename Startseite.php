<h1>BrauNUN</h1>
<br>
<br>
<br>
<h3>Willkommen auf der Verwaltungsseiter der Braunung</h3>
<br>
<h2>Unsere Produkte</h2>
<?php
include 'config.php';
include 'funktionen.php';
$query = 'select gt.getyp_name Art, 
                g.get_name Artikel,
                concat(gg.gegr_bezeichnung,\'/\',gg.gegr_flaschen) "L / Stück",
                g.get_alkohol "Alkohol in Prozent"
            from getraenk g, 
                getraenk_typ gt, 
                getraenkegroesse_getraenk ggg, 
                getraenkegroesse gg 
            where g.getyp_id=gt.getyp_id 
                and g.get_id=ggg.get_id 
                and gg.gegr_id=ggg.gegr_id
            order by Artikel, "L / Stück"';
$stmt = $con->prepare($query);
$stmt->execute();
showTable($stmt);
?>
