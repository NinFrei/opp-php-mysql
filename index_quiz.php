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
        echo "Quiz: Wunder der Natur";
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD'); 

        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8",$dbUser,$dbPassword);

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        
       
$query = $dbConnection->query("SELECT * from Questions");
$questions = $query->fetchAll(PDO::FETCH_ASSOC);

foreach //($questions as $question) 
        ($questions as $key => $question)
          {
        $subQuery = $dbConnection->prepare("SELECT * from Answerquiz where Answerquiz.QuestionId = ?");

        $subQuery->bindValue(1, $question['ID']);

        $subQuery->execute();

        $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);

        //$question['answers'] = $answers;
        $question[$key]['answers'] = $answers;

        print "<pre>";
        print_r($question);
        print "</pre>";

}






        
    exit();
        $query = $dbConnection->query("SELECT * FROM Questions");
        //$query = $dbConnection->query("SELECT * FROM Answerquiz");
        //$query = $dbConnection->query("SELECT Text, IsCorrect FROM Answer-quiz WHERE QuestionId=1");
        //$query = $dbConnection->query("SELECT * FROM Questions LEFT JOIN Answerquiz ON Answerquiz.QuestionId=Questions.ID");
        //$query = $dbConnection->query("SELECT Text, IsCorrectAnswer FROM Answerquiz WHERE QuestionId='1'"); 

        

        echo '<div class="container-fluid p-5">';
        echo '<div class="h3">Questions</div>';
        echo '<table class="table table-striped">';

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

        echo '</table>';
        echo '</div>';
        echo '</div>';
     
    
        ?>
        
</body>
</html>