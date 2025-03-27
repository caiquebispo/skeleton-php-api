<?php

namespace Skeleton\SkeletonPhpApplication\Core;

class Migration
{
    public static function create($event): void
    {
        $args = self::getArguments($event);

        if (empty($args[0])) {
            echo "Erro: Nome da migration não informado.\n";
            return;
        }

        $migrationName = $args[0];
        $filename = self::generateMigrationFilename($migrationName);
        $template = self::generateMigrationTemplate($migrationName);

        file_put_contents($filename, $template);
        echo "Migration criada: $filename\n";
    }
    public static function loadMigrationFiles(): void
    {
        foreach (glob(__DIR__ . '/../../../database/migrations/*.php') as $file) {
            require_once $file;
        }
    }
    private static function getArguments($event)
    {
        return $event instanceof \Composer\Script\Event ? $event->getArguments() : [$event];
    }
    private static function generateMigrationFilename($migrationName): string
    {
        $timestamp = date('Y_m_d_His');
        $directory = __DIR__ . '/../../../database/migrations/';
        return "{$directory}{$timestamp}_{$migrationName}.php";
    }
    private static function generateMigrationTemplate($migrationName): string
    {
        return <<<PHP
<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Cria a tabela de $migrationName se não existir
if (!Capsule::schema()->hasTable('$migrationName')) {

    Capsule::schema()->create('$migrationName', function (\$table) {
        \$table->increments('id');
        \$table->timestamps();
    });
    
}


PHP;
    }
    private static function findMigrationFile(string $migrationName): ?string
    {
        $migrationFiles = glob(__DIR__ . '/../../database/migrations/*_' . $migrationName . '.php');

        if (!empty($migrationFiles)) {
            return $migrationFiles[0];
        }

        return null;
    }
}