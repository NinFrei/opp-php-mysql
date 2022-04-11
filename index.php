<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
</head>
<body>
    <?php
        echo "Hello, we are starting to work with Databases and PHP PDO!"; 
        // Prepare connection parameters.
        // getenv(string $varname, bool $local_only = false): string|false .
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPasswort = getenv('DB_PASSWORD');


    // ich möchte als resultat eine Datenbankverbindung haben: $dbConnection = 
    // dazu muss ich aurufen : new PDO(); . Dieser Anruf liefert mir die Verbindung zur DB.
    // new PDO() benötigt folgende Argumente: "mysql:host=$dbHost;$dbName;charset=utf8"
    $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPasswort);

    // Tell PDO to throw Exceptions for every error.
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the SELECT query aun fetch all table rows as associative array
    // Bsp. Select * FROM Customers;
     //$query = $dbConnection->query("SELECT * FROM Books"); //tttps://www.php.net/manual/de/pdo.query.php
     //$query->fetch(PDO::FETCH_ASSOC);
     //$query = $dbConnection->query("SELECT * FROM Books");
     //$query = $dbConnection->query("SELECT * FROM Books WHERE ID=4");
     //$query = $dbConnection->query("SELECT * FROM Books WHERE Category='HTML'");
     //$query = $dbConnection->query("SELECT * FROM Books WHERE Year>2020");
     //$query = $dbConnection->query("SELECT Titel, Author, Category FROM Books WHERE 1");
     $query = $dbConnection->query("SELECT Titel, Author, Year FROM Books WHERE Year>2000 ORDER BY Year LIMIT 3");
    /*echo '<pre>';
    print_r($query);
    echo '<pre>';*/

    echo '<div class="container-fluid p-5">';
    echo '<div class="h3">My favourite Books</div>';
    echo '<table class="table table-striped">';

    // Print table header.

    echo '<thead>';
    echo '<tr>';

$columnCount = $query->columnCount();
// Get column metadata and the name of the column.
for ($i = 0; $i < $columnCount; $i++) {
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
    // Print table rows (for each book one row).
        echo '<tr>';
    // For each column (<td>) one value.

}




// End of table row.





    echo '</table>';
    echo '</div>';
    echo '</div>';
 

    ?>
    
</body>
</html>