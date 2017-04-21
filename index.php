<?php
$data = array();
header('Content-Type: text/html; charset=utf-8');
function display()
{
    $campaign = $_POST['campaign'];
    $agent = $_POST['agent'];
    $start_date = (empty($_POST['start_date'])) ? '2016-01-01' : $_POST['start_date'];
    $end_date = (empty($_POST['end_date'])) ? '2020-01-01' : $_POST['end_date'];
    echo "campaign :" . $campaign . " Agent : " . $agent . " start_date :" . $start_date . " End_date :" . $end_date;

    $servername = "localhost";
    $username = "root";
    $password = "mysql362951478";
    $dbname = "call_center";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    $sql = "SELECT clients.id id, clients.client_nature c_nature, 
 clients.joignable joignable, clients.qualification quali,
 campaign.name cm_name, agent.name a_name
FROM calls, clients, campaign, agent 
WHERE (calls.id_campaign = campaign.id)
AND (calls.id = clients.call_id)
AND (calls.id_agent = agent.id)
AND (campaign.name LIKE '%$campaign%')
AND (agent.name LIKE '%$agent%') 
AND (calls.end_time BETWEEN '$start_date' AND '$end_date') ";
    $result = mysqli_query($conn, $sql) or die(mysqli_connect_error());

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        $j = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $data_row = array();
            $client_id = $row['id'];
            array_push($data_row, $row['a_name']);
            array_push($data_row, $row['cm_name']);
            array_push($data_row, $row['c_nature']);
            array_push($data_row, $row['joignable']);
            array_push($data_row, $row['quali']);

            $sql_m = "SELECT * FROM marchandises WHERE client_id = '$client_id'";
            $result_m = mysqli_query($conn, $sql_m) or die(mysqli_connect_error());

            if (mysqli_num_rows($result_m) > 0) {
                while ($row_m = mysqli_fetch_assoc($result_m)) {
                    array_push($data_row, $row_m['marchandise_nature']);
                    array_push($data_row, $row_m['mode']);
                    array_push($data_row, $row_m['destination']);
                    array_push($data_row, $row_m['groupe']);
                    array_push($data_row, $row_m['term']);
                    array_push($data_row, $row_m['type']);
                    array_push($data_row, $row_m['frequence']);
                    array_push($data_row, $row_m['concurent']);
//                    echo ' 1'.$data_row[5].' -- 2 '.$data_row[6].' -- 3 '.$data_row[7].' -- 4 '.$data_row[8].' -- 5 '.$data_row[9]
//                        .' -- 6 '.$data_row[10].' -- 7 '.$data_row[11].' -- 8 '.$data_row[12];
                }
            }


            $data[$j] = $data_row;
            $j++;
//            array_push($data,array_values($data_row));

        }

        mysqli_close($conn);

        return $data;

    } else {

        mysqli_close($conn);

        return null;

    }


}

?>
<html>
<head>
    <meta charset="UTF-8">
    <!--  jQuery -->
    {{--
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    --}}
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    --}}
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <title>App Name - @yield('title')</title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Export Application</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="jumbotron">
        <h1>Export Resultat Brut</h1>
        <p>Entrez les champs de recherche aprés appuyez sur le button "Recherche"</p>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Agent Name</label>
                <input type="text" class="form-control" id="agent" name="agent" placeholder="Agent Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Campaign Name</label>
                <input type="text" class="form-control" id="campaign" name="campaign" placeholder="Campaign Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date Debut</label>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" name="start_date" placeholder="Date Debut">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date Fin</label>
                <div class="input-group date">
                    <input type="text" class="form-control datepicker" name="end_date" placeholder="Date Fin">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>

            <button type="submit" name="form" class="btn btn-default">Recherche</button>
        </form>
    </div>
    <div class="jumbotron">
        <h2>Resultat d'Export </h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>AGENT_NAME</th>
                    <th>CAMPAIGN NAME</th>
                    <th>CLIEN NATURE</th>
                    <th>JOIGNABLE</th>
                    <th>QUALIFICATION</th>
                    <th>-1-</th>
                    <th>NATURE MARCHANDISE</th>
                    <th>MODE I/E</th>
                    <th>DESTINATION</th>
                    <th>GROUPE</th>
                    <th>TERME</th>
                    <th>TYPE</th>
                    <th>FREQUENCE</th>
                    <th>CONCURENT</th>
                    <th>-2-</th>
                    <th>NATURE MARCHANDISE</th>
                    <th>MODE I/E</th>
                    <th>DESTINATION</th>
                    <th>GROUPE</th>
                    <th>TERME</th>
                    <th>TYPE</th>
                    <th>FREQUENCE</th>
                    <th>CONCURENT</th>
                    <th>-3-</th>
                    <th>NATURE MARCHANDISE</th>
                    <th>MODE I/E</th>
                    <th>DESTINATION</th>
                    <th>GROUPE</th>
                    <th>TERME</th>
                    <th>TYPE</th>
                    <th>FREQUENCE</th>
                    <th>CONCURENT</th>
                    <th>-4-</th>
                    <th>NATURE MARCHANDISE</th>
                    <th>MODE I/E</th>
                    <th>DESTINATION</th>
                    <th>GROUPE</th>
                    <th>TERME</th>
                    <th>TYPE</th>
                    <th>FREQUENCE</th>
                    <th>CONCURENT</th>
                    <th>-5-</th>
                    <th>NATURE MARCHANDISE</th>
                    <th>MODE I/E</th>
                    <th>DESTINATION</th>
                    <th>GROUPE</th>
                    <th>TERME</th>
                    <th>TYPE</th>
                    <th>FREQUENCE</th>
                    <th>CONCURENT</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_POST['form'])) {
                    $data2 = display();
                    $count = sizeof($data2);
//                    echo '<br>'.$count;
//                    die();
//                    $cpt = 0;
                    for ($i = 0; $i < $count; $i++) {
//                    $count--;
                        echo "<tr>";
                        echo '<td></td>';
//                    echo "<td>".$data2.count()."</td>";
                        echo '<td>' . $data2[$i][0] . '</td>';
                        echo '<td>' . $data2[$i][1] . '</td>';
                        echo '<td>' . $data2[$i][2] . '</td>';
                        echo '<td>' . $data2[$i][3] . '</td>';
                        echo '<td>' . $data2[$i][4] . '</td>';
                        echo '<td></td>';
                        echo '<td>' . $data2[$i][5] . '</td>';
                        echo '<td>' . $data2[$i][6] . '</td>';
                        echo '<td>' . $data2[$i][7] . '</td>';
                        echo '<td>' . $data2[$i][8] . '</td>';
                        echo '<td>' . $data2[$i][9] . '</td>';
                        echo '<td>' . $data2[$i][10] . '</td>';
                        echo '<td>' . $data2[$i][11] . '</td>';
                        echo '<td>' . $data2[$i][12] . '</td>';
                        echo '<td></td>';
                        echo '<td>' . $data2[$i][13] . '</td>';
                        echo '<td>' . $data2[$i][14] . '</td>';
                        echo '<td>' . $data2[$i][15] . '</td>';
                        echo '<td>' . $data2[$i][16] . '</td>';
                        echo '<td>' . $data2[$i][17] . '</td>';
                        echo '<td>' . $data2[$i][18] . '</td>';
                        echo '<td>' . $data2[$i][19] . '</td>';
                        echo '<td>' . $data2[$i][20] . '</td>';
                        echo '<td></td>';
                        echo '<td>' . $data2[$i][21] . '</td>';
                        echo '<td>' . $data2[$i][22] . '</td>';
                        echo '<td>' . $data2[$i][23] . '</td>';
                        echo '<td>' . $data2[$i][24] . '</td>';
                        echo '<td>' . $data2[$i][25] . '</td>';
                        echo '<td>' . $data2[$i][26] . '</td>';
                        echo '<td>' . $data2[$i][27] . '</td>';
                        echo '<td>' . $data2[$i][28] . '</td>';
                        echo '<td></td>';
                        echo '<td>' . $data2[$i][29] . '</td>';
                        echo '<td>' . $data2[$i][30] . '</td>';
                        echo '<td>' . $data2[$i][30] . '</td>';
                        echo '<td>' . $data2[$i][32] . '</td>';
                        echo '<td>' . $data2[$i][33] . '</td>';
                        echo '<td>' . $data2[$i][34] . '</td>';
                        echo '<td>' . $data2[$i][35] . '</td>';
                        echo '<td>' . $data2[$i][36] . '</td>';
                        echo '<td></td>';
                        echo '<td>' . $data2[$i][37] . '</td>';
                        echo '<td>' . $data2[$i][38] . '</td>';
                        echo '<td>' . $data2[$i][39] . '</td>';
                        echo '<td>' . $data2[$i][40] . '</td>';
                        echo '<td>' . $data2[$i][41] . '</td>';
                        echo '<td>' . $data2[$i][42] . '</td>';
                        echo '<td>' . $data2[$i][43] . '</td>';
                        echo '<td>' . $data2[$i][44] . '</td>';
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

{{--
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
--}}
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.fr.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>

