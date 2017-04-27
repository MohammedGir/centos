
<?php
    session_start();
        function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
            // tell the browser it's going to be a csv file
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=data.csv');
            // open raw memory as file so no temp files needed, you might run out of memory though
            $output = fopen('php://memory', 'w');
            // loop over the input array
            $array = array(array('Coco','Cici'),
                array('lolo','lili'));
            $count = sizeof($array);
            for($i = 0; $i < $count; $i++){
                $line = $array[$i];
                fputcsv($output, $line);
            }
            fpassthru($output);
        }
        if (isset($_POST['download'])) {
            $data = $_SESSION["data"];
            array_to_csv_download($data);
        }

?>
