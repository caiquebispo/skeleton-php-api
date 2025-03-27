<?php

namespace Skeleton\SkeletonPhpApplication\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    private static ?self $instance = null;
    private Capsule $capsule;

    private function __construct()
    {
        $this->capsule = new Capsule;

        $databaseConfig = [
            'driver'    => $_ENV['DB_CONNECTION'] ?? 'sqlite',
            'database'  => $_ENV['DB_DATABASE'] ?? __DIR__ . '/../../../database/skeleton_db.sqlite',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];

        // Adiciona host, username e password apenas se não for SQLite
        if ($databaseConfig['driver'] !== 'sqlite') {
            $databaseConfig += [
                'host'      => $_ENV['DB_HOST'] ?? 'localhost',
                'username'  => $_ENV['DB_USERNAME'] ?? 'root',
                'password'  => $_ENV['DB_PASSWORD'] ?? '',
            ];
        }

        $this->capsule->addConnection($databaseConfig);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCapsule(): Capsule
    {
        return $this->capsule;
    }
}
