
 <?php 
//database source and name, location and server
 $data_source_name='mysql:host=localhost; dbname=Stocks';
 $username = 'root';
 $password = '';
 
 try{
    $database = new PDO ($data_source_name, $username, $password);
        echo "<p> Database Connection succesfully</p>";
        
        $query= 'SELECT `Symbol`, `Name`, `Current_Price`, `ID` FROM `Stocks`';
        //preparation of the query
        $statement= $database->prepare($query);
        //run the query
        $statement->execute();
        
        $Stocks= $statement->fetchAll();
       
      $statement->closeCursor();
      
    
 } 
 catch (Exception $e) {
    $error_message = $e->getMessage();
        echo "<p>error message: $error_message</p>";
        

 }
       ?>

<!<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
        </title>         
    </head>
    <body>
        <table>

            <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Current Price</th>
            <th>ID</th>
            </tr>
             <?php foreach ($Stocks as $stockElement): ?>
            <tr>
                <td><?php echo $stockElement['Symbol'];?></td>
                <td><?php echo $stockElement['Name'];?></td>
                <td><?php echo $stockElement['Current_Price'];?></td>
                <td><?php echo $stockElement['ID'];?></td>
                
            </tr>
            
            <?php endforeach; ?>
        </table>
            

    </body>
   
   
</html>



/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

