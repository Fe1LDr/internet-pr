<?php
if ($_COOKIE['login'] == null || $_COOKIE['password'] == null)
{
    ob_start();
    $new_url = 'https://ukral.ru/login.php';
    header('Location: '.$new_url);
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Проверка текста</title>
    <meta charset="UTF-8">
    <style>
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>Проверка текста</h1>
<form>
    <label for="text">Введите текст:</label><br>
    <textarea id="text" name="text" rows="10" cols="50"></textarea><br>
    <button type="button" onclick="checkText()">Проверить</button>
    <input type="reset" value="Очистить">
</form>
<div id="output"></div>
<script>
    function checkText() {
        const specialWords = ['МИЭТ', 'MIET', 'PHP', 'JavaScript'];
        const text = document.getElementById('text').value;
        const outputDiv = document.getElementById('output');
        const forbiddenWords = ['script', 'http', 'SELECT', 'UNION', 'UPDATE', 'exe', 'exec', 'INSERT', 'tmp'];
        const pattern = new RegExp(forbiddenWords.join('|'), 'gi');

        if (!text) {
            outputDiv.innerText = 'Введите текст';
            return;
        }

        if (pattern.test(text)) {
            outputDiv.innerText = 'Текст содержит запрещенные слова';
            return;
        }

        const lines = text.split('\n');

        let resultHtml = '';
        for (const line of lines) {
            const words = line.split(' ');
            let lineHtml = '';
            for (const word of words) {
                const isSpecial = specialWords.includes(word);
                const isEnglish = /^[a-zA-Z]+$/.test(word);
                const wordHtml = isSpecial ? `<span class="bold">${word}</span>` :
                    isEnglish ? `<i>${word}</i>` :
                        word;
                lineHtml += `${wordHtml} `;
            }
            resultHtml += `${lineHtml.trim()}<br>`;
        }
        outputDiv.innerHTML = resultHtml;
    }
</script>
</body>
</html>