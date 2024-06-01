<?php

use App\Core\Router;

/**
 * @var string $message
 * @var int $statusCode
 * @var string $description
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $statusCode ?> | <?= $message ?></title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            color: #444;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            width: 100%;
            background-color: #fff;
            padding: 30px;
        }

        .error-message {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .error-message h2 {
            margin: 0;
        }

        .error-message .divider {
            margin: 0 10px;
            font-weight: normal;
            color: #999;
        }

        .description {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
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

        .route {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .method {
            width: 70px;
            font-weight: bold;
            text-align: right;
            margin-right: 10px;
        }

        .method-delete {
            color: #e3342f;
        }

        .method-get {
            color: #38c172;
        }

        .method-post {
            color: #3490dc;
        }

        .method-put {
            color: #ffed4a;
        }

        .path {
            flex: 1;
            text-align: left;
            color: #666;
        }

        .controller-method {
            font-size: 14px;
            color: #888;
            margin-left: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-message">
            <h2><?= $statusCode ?></h2>
            <span class="divider">|</span>
            <h2><?= $message ?></h2>
        </div>
        <p class="description"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
        <?php if (env('APP_ENV') === 'development' && $statusCode === 404) : ?>
            <pre>
                <?php foreach (Router::$handlers as $handler) {
                    $method = $handler['method'];
                    $path = $handler['path'];
                    $controller = '';
                    $controllerMethod = '';
                    if (is_array($handler['callback'])) {
                        $controller = $handler['callback'][0];
                        $controllerMethod = $handler['callback'][1];
                    }
                    echo '<div class="route">';
                    printf("<span class='method method-%s'>%s</span>", strtolower($method), $method);
                    printf("<span class='path'>%s</span>", $path);
                    if ($controller && $controllerMethod) {
                        printf("<span class='controller-method'>%s@%s</span>", $controller, $controllerMethod);
                    }
                    echo '</div>';
                }
                ?>
            </pre>
        <?php endif; ?>
    </div>
</body>

</html>
