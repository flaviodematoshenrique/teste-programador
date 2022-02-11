<?php
if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists( $tabela );

// Cria a tabela produtos
$schema->create($tabela, function($table){
	
	$table->increments('id');
	$table->string('titulo', 100);
	$table->text('descricao');
	$table->decimal('preco', 11, 2);
	$table->string('fabricante', 60);
	$table->timestamps();

});

// Preenche a tabela
$db->table($tabela)->insert([
    'titulo' => 'Fotografia Casamento',
    'descricao' => 'Foto Casal, familia e amigos na celebracao religiosa e na festa',
    'preco' => 899.00,
    'fabricante' => 'Canon',
    'created_at' => '2022-10-22',
    'updated_at' => '2022-10-22'
]);

$db->table($tabela)->insert([
    'titulo' => 'Foto Feminina',
    'descricao' => 'Fotografia Mulheres/Poses',
    'preco' => 4999.00,
    'fabricante' => 'Nikon',
    'created_at' => '2022-10-01',
    'updated_at' => '2022-10-01'
]);

