<?php

namespace Skeleton\SkeletonPhpApplication\Core\Console;

use Composer\Script\Event;

class Controller
{
    public static function create($event): void
    {
        $args = self::getArguments($event);

        if (empty($args[0])) {
            throw new \InvalidArgumentException('Controller name must be provided');
        }

        $controllerName = $args[0];
        $namespace = self::verifyContainsSubDirectory($args);
        $className = self::getClassName($controllerName);
        $directoryPath = self::getDirectoryPath($controllerName);
        $filePath = self::getFilePath($directoryPath, $className);

        if (file_exists($filePath)) {
            throw new \RuntimeException("Controller {$className} already exists at {$filePath}");
        }

        self::ensureDirectoryExists($directoryPath);
        self::createControllerFile($filePath, $className, $namespace);

        echo "Controller {$className} created successfully at {$filePath}\n";
    }
    private static function verifyContainsSubDirectory(array $args): string
    {
        $baseNamespace = 'Skeleton\SkeletonPhpApplication\Controllers';

        if (str_contains($args[0], '/')) {
            $subDirectory = explode('/', $args[0])[0];
            return "namespace {$baseNamespace}\\{$subDirectory};";
        }

        return "namespace {$baseNamespace};";
    }

    private static function getArguments($event): array
    {
        return $event instanceof Event ? $event->getArguments() : [$event];
    }

    private static function getClassName(string $controllerName): string
    {
        $parts = explode('/', $controllerName);
        $lastPart = end($parts);
        return ucfirst($lastPart);
    }

    private static function getDirectoryPath(string $controllerName): string
    {
        $basePath = __DIR__ . '/../../Controllers/';

        if (str_contains($controllerName, '/')) {
            $subDirectory = explode('/', $controllerName)[0];
            return $basePath . $subDirectory . '/';
        }

        return $basePath;
    }

    private static function getFilePath(string $directoryPath, string $className): string
    {
        return $directoryPath . $className . '.php';
    }

    private static function ensureDirectoryExists(string $directoryPath): void
    {
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
    }

    private static function createControllerFile(string $filePath, string $className, string $namespace): void
    {
        $content = <<<PHP
<?php

{$namespace}
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class {$className} extends Controller
{
    public function __construct()
    {
        // Controller initialization
    }

    // Add your controller methods here
}

PHP;

        file_put_contents($filePath, $content);
    }
}