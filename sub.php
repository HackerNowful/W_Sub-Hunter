<!DOCTYPE html>
<html>
<head>
    <title>Hacker Nowful</title>
    <style>
        body {
            background-color: #000;
            color: #00FF00;
        }

        .card {
            background-color: #111;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
        }

        .card img {
            width: 200px;
            margin-right: 300px;
        }

        .card h1 {
            flex: 1;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .table-wrapper {
            margin: 10px;
        }

        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #00FF00;
            padding: 8px;
        }

        h1, h2, label, input, p {
            color: #00FF00;
        }

        input[type="text"], input[type="submit"] {
            background-color: #111;
            color: #00FF00;
            border: 1px solid #00FF00;
            padding: 5px 10px;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #00FF00;
            color: #111;
        }

        .download-btn {
            background-color: #111;
            color: #00FF00;
            border: 1px solid #00FF00;
            padding: 5px 10px;
            border-radius: 3px;
            margin-top: 10px;
            cursor: pointer;
        }

        .download-btn:hover {
            background-color: #00FF00;
            color: #111;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="hypesec.png" alt="Logo">
        <center>
            <h1>Sub-Domain Finder</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="target">Enter your Target Domain:</label>
                <br>
                <br>
                <input type="text" name="target" id="target" required>
                <input type="submit" name="submit" value="Scan">
            </form>
        </center>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target = $_POST["target"];
        echo "<div class='card'>";
        echo "<center><h2>Scanning: " . $target . "</h2><br><br></center>";
        $output = shell_exec("dmitry -s " . $target);

        preg_match_all('/\b(HostName|HostIP)\s*:\s*([^\n]+)/i', $output, $matches, PREG_SET_ORDER);

        if (!empty($matches)) {
            echo '<div class="container">';

            echo '<div class="table-wrapper">';
            echo "<table>";

            foreach ($matches as $match) {
                if ($match[1] === "HostName") {
                    echo "<tr><td>" . $match[1] . "</td><td>" . $match[2] . "</td></tr>";
                }
            }
            echo "</table>";
            echo '</div>';

            echo '<div class="table-wrapper">';
            echo "<table>";
            foreach ($matches as $match) {
                if ($match[1] === "HostIP") {
                    echo "<tr><td>" . $match[1] . "</td><td>" . $match[2] . "</td></tr>";
                }
            }
            echo "</table>";
            echo '</div>';

            echo '</div>';
            echo '<center><div class="container">';
            echo '<a class="download-btn" href="download.php?type=txt&output=' . urlencode($output) . '">Download as TXT</a>';
            echo '<a class="download-btn" href="download.php?type=csv&output=' . urlencode($output) . '">Download as CSV</a>';
            echo '</div></center>';
            echo '<center><h2>Hacker Nowful</h2></center>';
            echo '<center><p>This Script Was made by Hacker Nowful !
For More Script or any Doubt :</p></center>';
echo '<center><p>Insta   : mr_white_hat._</p></center>';
echo '<center><p>Google  : Hacker Nowful</p></center>';
echo '<center><p>Git-Hub  : Hacker Nowful</p></center>';
echo '<center><p>Youtube : Hypesec Infotech </p></center>';
        } else {
            echo "<p>No results found.</p>";
        }
        echo "</div>";
    }
    ?>
</body>
</html>
