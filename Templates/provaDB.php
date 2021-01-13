<html>
    <head>
    </head>
    <body>
        <?php 
            include_once '../Data/prodotto.php';
            include_once '../PDO/database.php';

            $database = new Database();
            $db = $database->getConnection();
            $coso = new Prodotto($db);
            $stmt = $coso->getAll();
            $num = $stmt->rowCount();
            if($num>0){
  
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Nome</th>";
                        echo "<th>Prezzo</th>";
                    echo "</tr>";
              
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              
                        extract($row);
              
                        echo "<tr>";
                            echo "<td>{$nome}</td>";
                            echo "<td>{$prezzo}</td>";
                        echo "</tr>";
                    }
                echo "</table>";
              
                // paging buttons will be here
            }

        ?>
    </body>
</html>