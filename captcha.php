<?php
session_start();

// Параметры изображения
$width = 160;
$height = 60;
$image = imagecreatetruecolor($width, $height);

// Цвета
$bgColor = imagecolorallocate($image, 255, 255, 255); // белый фон
$waveColor = imagecolorallocate($image, 150, 150, 255);

// Заливаем фон
imagefill($image, 0, 0, $bgColor);

// Генерация случайного текста
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';
$captchaText = '';
for ($i = 0; $i < 5; $i++) {
    $captchaText .= $chars[rand(0, strlen($chars) - 1)];
}
$_SESSION['captcha'] = $captchaText;

// Пути к шрифтам (добавь несколько TTF в папку, например, Arial, Verdana, Comic Sans)
$fonts = [
    __DIR__ . '/font.ttf',
    
];

// Добавляем линии помех
for ($i = 0; $i < 7; $i++) {
    $lineColor = imagecolorallocate($image, rand(100,200), rand(100,200), rand(200,255));
    imagesetthickness($image, rand(1, 3));
    imageline($image, rand(0, $width), rand(0, $height),
                     rand(0, $width), rand(0, $height), $lineColor);
}

// Добавляем точки-шум
for ($i = 0; $i < 500; $i++) {
    $dotColor = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
    imagesetpixel($image, rand(0, $width-1), rand(0, $height-1), $dotColor);
}

// Рисуем символы с разными стилями
for ($i = 0; $i < strlen($captchaText); $i++) {
    $fontSize = rand(22, 30);
    $angle = rand(-25, 25);
    $x = 20 + $i * 28 + rand(-2, 2);
    $y = rand(35, 50);

    $font = $fonts[array_rand($fonts)];
    $textColor = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));

    imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $font, $captchaText[$i]);
}

// Отправка PNG изображения
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
