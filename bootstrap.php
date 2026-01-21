<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Dotenv\Dotenv;
use Illuminate\Validation\Factory;
use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Setup Eloquent
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => $_ENV['DB_CONNECTION'] ?? 'mysql',
    'host'      => $_ENV['DB_HOST'] ?? 'localhost',
    'database'  => $_ENV['DB_DATABASE'] ?? 'pahal_ngo_db',
    'username'  => $_ENV['DB_USERNAME'] ?? 'root',
    'password'  => $_ENV['DB_PASSWORD'] ?? '',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional but good practice)
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM...
$capsule->bootEloquent();

// Setup Validation Factory
function getValidationFactory() {
    $filesystem = new Filesystem();
    $fileLoader = new FileLoader($filesystem, __DIR__ . '/lang');
    $translator = new Translator($fileLoader, 'en');
    $factory = new Factory($translator, new Container);
    return $factory;
}

// Global Validation Helper (Optional, mimics Laravel's validator())
function validator(array $data, array $rules, array $messages = [], array $customAttributes = []) {
    $factory = getValidationFactory();
    return $factory->make($data, $rules, $messages, $customAttributes);
}
