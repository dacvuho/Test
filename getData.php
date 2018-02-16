<?php
include_once("config.php");

//get content from url ftp://ftp.apnic.net/apnic/stats/apnic/delegated-apnic-latest
$url="ftp://ftp.apnic.net/apnic/stats/apnic/delegated-apnic-latest";
$content=file_get_contents($url);
$convert = explode("\n", $content); //create array separate by new line
try
{
    $conn->exec($sql_del);
    $conn->exec($sql_create);
    for ($i=0;$i<count($convert);$i++)
    {
        $line=trim($convert[$i]);
        if(substr($line,0,1)=="#")continue;
        $spitData=explode("|",$line);
        if(count($spitData)>=7 && $spitData[0]=="apnic")
        {

            //add to database;
            try
            {
                // prepare sql and bind parameters
                $stmt = $conn->prepare("INSERT INTO ip_records (`registry`, `cc`, `type`,`start`
                                    ,`value`,`date`,`status`)
    VALUES (:registry, :cc, :type, :start, :value, :date, :status)");

                $stmt->bindParam(':registry', $spitData[0]);
                $stmt->bindParam(':cc', $spitData[1]);
                $stmt->bindParam(':type', $spitData[2]);
                $stmt->bindParam(':start', $spitData[3]);
                $stmt->bindParam(':value', $spitData[4]);
                $stmt->bindParam(':date', $spitData[5]);
                $stmt->bindParam(':status', $spitData[6]);
                // insert a row

                $stmt->execute();

            }
            catch(PDOException $e)
            {
                echo "Error: " . $e->getMessage();
            }


        }
    }
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}



