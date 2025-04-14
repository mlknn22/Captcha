<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["captcha"] == $_SESSION["captcha"]) {
        $message = "<p class='success'>✅ Верно!</p>";
    } else {
        $message = "<p class='error'>❌ Неверная CAPTCHA.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPTCHA Проверка</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .captcha-container {
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .captcha-container img {
            display: block;
            margin: 10px auto;
            border-radius: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            box-sizing: border-box; 
        }

        .submit-btn, .refresh-btn {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px;
        }
        .submit-btn:hover {
            background: #0056b3;
        }
        .refresh-btn {
            background: #6c757d;
        }
        .refresh-btn:hover {
            background: #5a6268;
        }

        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="captcha-container">
    <h2>Введите код с картинки</h2>
    <?php if (isset($message)) echo $message; ?>
    
    <form method="post">
        <img src="captcha.php" alt="CAPTCHA" id="captcha-img">
        <button type="button" class="refresh-btn" onclick="refreshCaptcha()">🔄 Обновить CAPTCHA</button>
        <input type="text" name="captcha" placeholder="Введите код" required>
        <button type="submit" class="submit-btn">Проверить</button>
    </form>
</div>

<script>
    function refreshCaptcha() {
        const img = document.getElementById('captcha-img');
        img.src = 'captcha.php?rand=' + Math.random();
    }
</script>

</body>
</html>
