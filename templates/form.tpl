<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile a {
            color: #fff;
            text-decoration: none;
            padding: 0.25rem 0.5rem;
            border: none;
            background: transparent;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .title{
            border: #ff0000 3px solid;
            height: 150px;
            width: 30%;
            margin: 0 auto;
            border-radius: 20px;
            align-items: center;
            text-align: center;
        }
        .question{
            border: black 3px solid;
            height: 200px;
            width: 30%;
            margin: 0 auto;
            margin-top: 20px;
            padding: 10px;
            border-radius: 20px;
            align-items: center;
            text-align: center;
        }


    </style>
</head>
<body>

<div class="navbar">
    <div class="container">
        <h1>Form</h1>
    </div>

    <div class="profile">
        <div class="container">
            <a href="index.php" class="btn btn-action tooltip tooltip-bottom" data-tooltip="Logout">
                <i class="icon icon-share"></i>
            </a>
        </div>
    </div>
</div>


<br><br>

<div class="title">
    <h3><?=$questions[0]['titolo'] ?></h3>
    <p><?=$questions[0]['descrizione'] ?></p>
</div>

<!--domande-->
<form method="get">

    <?php
$i = 1;
foreach ($questions as $question): ?>
    <div class="question">
        <p>Question number <?= $i ?>: </p>
        <p><?= $question['domanda'] ?>: </p>
        <input type="range" name="question_<?= $i ?>" min="0" max="7" class="range" step="1" />
        <span class="range-value"></span>
    </div>
    <?php $i++; endforeach; ?>

    <input type="submit" value="invia risposte" id="submit-button">


</form>



<script>
    var rangeInputs = document.querySelectorAll('input[type="range"]');
    rangeInputs.forEach(function (rangeInput) {
        rangeInput.addEventListener('input', function () {
            var rangeValueSpan = rangeInput.nextElementSibling;
            rangeValueSpan.textContent = rangeInput.value;
        });
        rangeInput.dispatchEvent(new Event('input'));
    });


    function confirmSubmission(event) {
        var confirmed = confirm("Are you sure you want to submit your responses?");
        if (!confirmed) {
        event.preventDefault(); // Prevent form submission if not confirmed
    }
    }

        document.addEventListener("DOMContentLoaded", function() {
        var submitButton = document.getElementById("submit-button");
        submitButton.addEventListener("click", confirmSubmission);
    });

</script>

</body>
</html>
