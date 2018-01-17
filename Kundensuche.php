<h4>Suchseite</h4>
<br>
<?php
/**
 * Created by PhpStorm.
 * User: Severin
 * Date: 10.01.2018
 * Time: 15:00
 */
if(!isset($_GET['Preislisteanzeigen']))
{
    if (!isset($_GET['suchestarten'])) {
        ?>
        <form mehtod="GET" action>
            <label for="name">Kundenname:</label>
            <input type="text" name="name" required placeholder="z.B.: Cola, oder Huber" id="name">
            <br>
            <input type="hidden" name="seite" value="Kundensuche">
            <input type="submit" name="suchestarten" value="suchestarten">
        </form>
        <?php
    } else {
        include 'config.php';
        include 'funktionen.php';
        $counter = 0;
        $name = $_GET['name'];
        $query = 'select concat_ws(" ",kun_vname,kun_nname,kun_firma) "Kundenname: ",kun_id from kunde where kun_vname like "%"?"%" or kun_nname like "%"?"%" or kun_firma like "%"?"%"';
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $name);
        $stmt->execute();

        // 1. Anzahl der Attribute ermitteln

        // 2. leeres Array erstellen
        $attribute = array();
        // 3. Attributeigenschaften in das Array "schreiben"

        $kundennamen = array();
        $kunden_id = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            $kundennamen[] = $row[0];
            $kunden_id[] = $row[1];
        }
        ?>

        <form mehtod="GET" action>
            <table border="1">
                <tr>
                    <th>Kundennamen:</th>
                </tr>
                <?php
                foreach ($kundennamen as $kundenname) {
                    echo '<tr>';
                    echo '<td> <input type="radio" name="kunden_id" value="' . $kunden_id[$counter] . '"> ' . $kundenname . '</td>';
                    echo '</tr>';
                    $counter++;
                }
                ?>
                <table>
                    <input type="hidden" name="seite" value="Kundensuche">
                    <input type="submit" name="Preislisteanzeigen" value="Preisliste anzeigen">
        </form>
        <?php
    }
}
else
{
    include 'config.php';
    include 'funktionen.php';
    $kun_id = $_GET['kunden_id'];
    $query = ' select gt.getyp_name Art,
			g.get_name Artikel,
            a.adr_ort Ort,
            case when g.get_alkohol=0 then \'\' else g.get_alkohol end Alkoholgehalt,
            p.preis_preis Preis,
            case when p.preis_datum=\'9999-12-31 00:00:00\' then \'/\' else p.preis_datum end  "Preis gültig bis"
			from	kunde k, 
					preisliste p,
                    getraenkegroesse_getraenk ggg,
                    getraenk g,
                    getraenk_typ gt,
                    kunden_adresse ka,
                    adresse a
			where	k.kun_id=p.kun_id
				and	p.gege_id=ggg.gege_id
                and ggg.get_id=g.get_id
                and g.getyp_id=gt.getyp_id
                and k.kun_id=ka.kun_id
                and ka.adr_id=a.adr_id
                and ka.kuad_datum>curdate()
                and k.kun_id=?
            order by gt.getyp_id,g.get_name, g.get_alkohol,"Preis gültig bis"';
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $kun_id);
    $stmt->execute();
    showTable($stmt);
}
?>