<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv= "X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pico.min.css">
    <title>Document</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="num01">Number 1:</label>
        <input type="number" name="num01" placeholders="Number 1" required>

        <select name="operator">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
            <option value="power">^</option>
            <option value="root">√</option>
        </select>

        <label for="num02">Number 2:</label>
        <input type="text" name="num02" placeholders="Number 2" required>

        <button>Calculate</button>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Grab input data
            $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            // Error handling
            $errors = false;

            if (empty($num01) || empty($num02) || empty($operator)) {
                echo "<p class='calc-error'>Fill in all fields!</p>";

                $errors = true;
            }

            if (!(is_numeric($num01)) || !(is_numeric($num02))) {
                echo "<p class='calc-error'>Numbers only!</p>";

                $errors = true;
            }


            // If no errors, run the calculation
            if (!$errors) {
                $value = 0;

                switch($operator) {
                    case "add":
                        $value = $num01 + $num02;
                        $symbol = "+";

                        break;
                    case "subtract":
                        $value = $num01 - $num02;
                        $symbol = "-";

                        break;
                    case "multiply":
                        $value = $num01 * $num02;
                        $symbol = "*";

                        break;
                    case "divide":
                        $value = $num01 / $num02;
                        $symbol = "/";

                        break;
                    case "power":
                        $value = $num01 ** $num02;
                        $symbol = "^";

                        break;
                    case "root":
                        $value = pow($num02, 1 / $num01);
                        $symbol = "√";

                        break;
                    default:
                        echo "<p class='calc-error'>Something went wrong, Try again later...</p>";
                }

                echo "<p class='calc-result'>" . $num01 . " " . $symbol . " " . $num02 . " = " . $value . "</p>";
            }
        }
    ?>
</body>
</html>