<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            color: #636b6f;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        main {
            padding: 40px;
            border-radius: 8px;
            max-width: 1000px;
            width: 100%;
        }
        h1 {
            color: #e3342f;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: left;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
        }
        pre {
            text-align: left;
            background-color: #f1f5f8;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 14px;
            line-height: 1.5;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .error-file {
            font-size: 14px;
            color: #b0bec5;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1><?= htmlspecialchars($description->getMessage(), ENT_QUOTES, 'UTF-8') ?></h1>
        </div>
        <?php if (env('APP_ENV') === 'development') : ?>
            <p class="error-file"><?= htmlspecialchars($description->getFile(), ENT_QUOTES, 'UTF-8') ?> at line <?= htmlspecialchars($description->getLine(), ENT_QUOTES, 'UTF-8') ?></p>
            <pre>Error Trace: <?= htmlspecialchars($description->getTraceAsString(), ENT_QUOTES, 'UTF-8') ?></pre>
        <?php endif; ?>
    </main>
</body>
</html>
