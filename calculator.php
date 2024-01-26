<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .power-rate-container {
            margin-top: 20px;
            border: 2px solid #007bff;
            padding: 10px;
        }
        .power-rate-container strong {
            margin-top: 10px;
            margin-bottom: 10px;
            display: inline-block;
            font-weight: bold;
            color: #004085; /* Dark blue color */
         }   

        .bill-details {
            margin-top: 20px;
        }

        .unit-text {
            font-size: 0.9em; /* Adjust the font size as needed */
        }


    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Calculate</h2>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="voltage">Voltage:</label>
                        <input type="number" step="0.01" class="form-control" id="voltage" name="voltage" value="19" required>
                        <p class="unit-text">(Voltage, V)</p>
                        <div class="invalid-feedback">Please enter voltage.</div>
                    </div>
                    <div class="form-group">
                        <label for="current">Current:</label>
                        <input type="number" step="0.01" class="form-control" id="current" name="current" value="3.24" required>
                        <p class="unit-text">(Ampere, A)</p>
                        <div class="invalid-feedback">Please enter current.</div>
                    </div>
                    <div class="form-group">
                        <label for="rate">Current Rate:</label>
                        <input type="number" step="0.01" class="form-control" id="rate" name="rate" value="21.80" required>
                        <p class="unit-text">(sen/kWh)</p>
                        <div class="invalid-feedback">Please enter rate.</div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" style="margin-top: 20px; margin-bottom: 20px;" class="btn btn-primary">Calculate</button>
                    </div>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $voltage = $_POST['voltage'];
                    $current = $_POST['current'];
                    $rate_sen_kWh = $_POST['rate'];
                    $rate_RM = $rate_sen_kWh / 100;

                    $power = $voltage * $current;
                    $energy = ($power / 1000);
                    $totalCharge = $energy * ($rate_RM);

                    echo "<div class='power-rate-container'>";
                    echo "<strong>POWER:</strong> <strong style='font-weight: bold; color: #004085;'>" . number_format($energy, 5) . " kW </strong><br>";
                    echo "<strong>RATE:</strong> <strong style='font-weight: bold; color: #004085;'>" . number_format($rate_RM, 3) . " RM</strong>";
                    echo "</div>";

                    echo "<div class='bill-details'>";
                    echo "<h4 class='mb-3'>Bill Details:</h4>";
                    echo "<table class='table'>";
                    echo "<thead><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead>";
                    echo "<tbody>";

                    for ($hour = 1; $hour <= 24; $hour++) {
                        $hourEnergy = number_format($energy * $hour, 5);
                        $hourTotal = number_format($totalCharge * $hour, 2);

                        echo "<tr><td>$hour</td><td>$hour</td><td>$hourEnergy</td><td>$hourTotal</td></tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Bootstrap 4 form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
