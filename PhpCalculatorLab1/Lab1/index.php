<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head> 
        
        <meta charset="UTF-8">
        <title>Product Discount calculator</title>
        <style>
        body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 1 em;
        padding: 0;
        }
        
        main{
            width: 450px;
            margin: 0 auto;
            padding: 1.5 em;
            background: white;
            border: 2px solid pink;
           
        }
        hi1{
            color: blueviolet;
        }
        
        label{
            width: 10em;
            padding-right: 1 em;
            float: left;
        }
        
        #data input{
            float: left;
            width: 15 em;
            margin-bottom: .5 em;
            
        }
        
        #data span{
            padding-left: .25;
        }
        
        #buttons input{
            float: left;
            margin-bottom: .5 em;
            
        }
        br{
            clear: left;
            
        }
        
       </style> 
    </head>
    
    <body>
        <main>
            <h1>Product Disc. Calculator</h1>
             <form action="" method="post">
            <div id="data">
                <label>Hourly Wage:</label>
                <input type="text" name="hourly_wage" required>
                <br>
                
                <label>Hours Worked:</label>
                <input type="text" name="hours_worked" required>
                <br>
                
                <label>Tax Rate:</label>
                <input type="text" name="tax_rate" required><span>%</span>
                <br>
            </div>  
            
            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" value="Calculate Pay">
                <br>
            </div>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos ingresados por el usuario
            $hourly_wage = (float)$_POST['hourly_wage'];
            $hours_worked = (float)$_POST['hours_worked'];
            $tax_rate = (float)$_POST['tax_rate'];

            // Calcular el pago bruto
            $overtime_hours = max(0, $hours_worked - 40);
            $regular_hours = $hours_worked - $overtime_hours;
            $overtime_rate = $hourly_wage * 1.5;

            $regular_pay = $regular_hours * $hourly_wage;
            $overtime_pay = $overtime_hours * $overtime_rate;
            $gross_pay = $regular_pay + $overtime_pay;

            // Calcular los impuestos y el pago neto
            $taxes_owed = $gross_pay * ($tax_rate / 100);
            $net_pay = $gross_pay - $taxes_owed;

            // Mostrar los resultados
            echo "<h2>Results:</h2>";
            echo "<p><strong>Gross Pay:</strong> $" . number_format($gross_pay, 2) . "</p>";
            echo "<p><strong>Taxes Owed:</strong> $" . number_format($taxes_owed, 2) . "</p>";
            echo "<p><strong>Net Pay:</strong> $" . number_format($net_pay, 2) . "</p>";
        }
        ?>
    </main>
</body>
</html>

