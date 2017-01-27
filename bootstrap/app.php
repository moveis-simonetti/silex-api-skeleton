<?php

use Silex\Application;

require_once __DIR__ . "/helpers.php";

$app = new Application();

$app['debug'] = env('APP_DEBUG', false);

$dotenv = new Dotenv\Dotenv(ROOT_PATH);
$dotenv->overload();

$app->register(
    new Silex\Provider\MonologServiceProvider(),
    require_once(ROOT_PATH . '/app/configs/monolog.php')
);

$app->register(new Silex\Provider\DoctrineServiceProvider(),
    require_once(ROOT_PATH . '/app/configs/database.php')
);

$app->register(new \Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider(),
    require_once(ROOT_PATH . '/app/configs/orm.php')
);

$app->register(new \Kurl\Silex\Provider\DoctrineMigrationsProvider(),
    require_once(ROOT_PATH . '/app/configs/migrations.php')
);

$loader = require __DIR__ . '/../vendor/autoload.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

if ($app['debug']) {
    $logger = new Doctrine\DBAL\Logging\DebugStack();
    $app['db.config']->setSQLLogger($logger);
    $app->error(function (\Exception $e) use ($app, $logger) {
        if ($e instanceof PDOException and count($logger->queries)) {
            $query = array_pop($logger->queries);
            $app['monolog']->err($query['sql'], array(
                'params' => $query['params'],
                'types'  => $query['types'],
            ));
        }
    });
    $app->after(function () use ($app, $logger) {
        foreach ($logger->queries as $query) {
            $app['monolog']->debug($query['sql'], array(
                'params' => $query['params'],
                'types'  => $query['types'],
            ));
        }
    });
}

require_once __DIR__ . '/../app/routes/web.php';
require_once __DIR__ . '/../app/routes/api.php';

return $app;