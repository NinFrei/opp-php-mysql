<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php
        echo "Hello, we are starting to work with Databases and PHP PDO!"; 
       
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD'); 

        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8",$dbUser,$dbPassword);

        // Tell PDO to throw Exceptions for every error.
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $dbConnection->query("SELECT * FROM Books");
        $query->fetch(PDO::FETCH_ASSOC);
        echo '<div class="container-fluid p5">';
        echo '<div class="h3">My favourite Books';
        echo '<table class="table table-striped">';


        echo '<thead> ';
        echo '<tr> ';

        

        $columnCount = $query->columnCount();

        for ($i = 0; $i < $columnCount; $i++){
            $columnInfo = $query->getColumnMeta($i);
            $columnName = $columnInfo['name'];
            echo "<td>$columnName</td>";
        }
 

        echo '</tr>';
        echo '</thead>';


    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';

        foreach ($row as $columnName => $value) {
            echo "<td>$value</td>";
        }
       
        echo '</tr>';
    }
        
         
       
       
        echo '</table>';
        echo '</div>';
        echo '</div>';

        

        //echo '<pre>';
        //print_r($query);
        //echo'</pre>';

        ?>
    
</body>
</html>