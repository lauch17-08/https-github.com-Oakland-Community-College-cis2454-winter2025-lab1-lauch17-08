<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<!DOCTYPE html>
<?php
$name = $income = $deductions = '';
$errors = [];
$standardDeduction = 14600;

// Define tax brackets (2024 rates)
$brackets = [
    ['max' => 11600, 'rate' => 0.10],
    ['max' => 47150, 'rate' => 0.12],
    ['max' => 100525, 'rate' => 0.22],
    ['max' => 191950, 'rate' => 0.24],
    ['max' => 243725, 'rate' => 0.32],
    ['max' => 609350, 'rate' => 0.35],
    ['max' => PHP_FLOAT_MAX, 'rate' => 0.37]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 
    $name = trim($_POST['name'] ?? '');
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Validate income
    $income = trim($_POST['income'] ?? '');
    if (!is_numeric($income) || $income < 0) {
        $errors[] = "Please enter a valid income amount";
    }

    // Validate deductions
    $deductions = trim($_POST['deductions'] ?? '');
    if (!is_numeric($deductions) || $deductions < 0) {
        $errors[] = "Please enter a valid deductions amount";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Tax Calculator</title>
    <style>
        body { font-family: monospace; margin: 20px; }
        .error { color: red; }
        .result { margin-top: 20px; white-space: pre-line; }
    </style>
</head>
<body>
    <h1>Simple Tax Calculator</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <p>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
        </p>
        <p>
            <label for="income">Gross Income:</label><br>
            <input type="number" id="income" name="income" step="0.01" value="<?= htmlspecialchars($income) ?>">
        </p>
        <p>
            <label for="deductions">Total Deductions:</label><br>
            <input type="number" id="deductions" name="deductions" step="0.01" value="<?= htmlspecialchars($deductions) ?>">
        </p>
        <button type="submit">Calculate Taxes</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
        // Convert inputs to numbers
        $income = floatval($income);
        $deductions = floatval($deductions);
        
      
        $finalDeductions = max($deductions, $standardDeduction);
        $adjustedGrossIncome = max(0, $income - $finalDeductions);
        
        // Calculate taxes for each bracket
        $totalTax = 0;
        $remainingIncome = $adjustedGrossIncome;
        $previousMax = 0;
        
        echo "<div class='result'>";
        echo "Tax Calculation for " . htmlspecialchars($name) . "\n\n";
        echo sprintf("Gross Income : $%s\n", number_format($income, 2));
        echo sprintf("Total Deductions : $%s\n", number_format($finalDeductions, 2));
        echo sprintf("Adjusted Gross Income : $%s\n", number_format($adjustedGrossIncome, 2));
        
        foreach ($brackets as $bracket) {
            $bracketIncome = min(max(0, $remainingIncome), $bracket['max'] - $previousMax);
            $bracketTax = $bracketIncome * $bracket['rate'];
            $totalTax += $bracketTax;
            
            echo sprintf("Taxes Owed at %.0f%% bracket : $%s\n", 
                $bracket['rate'] * 100, 
                number_format($bracketTax, 2)
            );
            
            $remainingIncome -= $bracketIncome;
            $previousMax = $bracket['max'];
            
            if ($remainingIncome <= 0) break;
        }
        
        echo sprintf("Total Taxes Owed : $%s\n", number_format($totalTax, 2));
        echo sprintf("Taxes Owed as percentage of gross income: %.2f%%\n", 
            ($totalTax / $income) * 100);
        echo sprintf("Taxes Owed as percentage of adjusted gross income: %.2f%%", 
            ($totalTax / $adjustedGrossIncome) * 100);
        echo "</div>";
    }
    ?>
</body>
</html>
