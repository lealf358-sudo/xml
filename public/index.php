<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// 1 - Status
$app->get('/status', function ($request, $response) {
    $dados = [
        'status' => 'online',
        'mensagem' => 'API funcionando corretamente'
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 2 - Filmes favoritos
$app->get('/filmes/favoritos', function ($request, $response) {
    $dados = [
        'filmes' => [
            'Interestelar',
            'Vingadores: Ultimato',
            'Homem-Aranha: Sem Volta para Casa'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 3 - Filmes de ação
$app->get('/filmes/acao', function ($request, $response) {
    $dados = [
        'genero' => 'Ação',
        'filmes' => [
            'John Wick',
            'Vingadores: Ultimato',
            'Missão Impossível'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 4 - Filmes de comédia
$app->get('/filmes/comedia', function ($request, $response) {
    $dados = [
        'genero' => 'Comédia',
        'filmes' => [
            'As Branquelas',
            'Todo Mundo em Pânico',
            'Gente Grande'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 5 - Filmes de terror
$app->get('/filmes/terror', function ($request, $response) {
    $dados = [
        'genero' => 'Terror',
        'filmes' => [
            'Invocação do Mal',
            'It: A Coisa',
            'A Freira'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 6 - Filmes de animação
$app->get('/filmes/animacao', function ($request, $response) {
    $dados = [
        'genero' => 'Animação',
        'filmes' => [
            'Toy Story',
            'Shrek',
            'Homem-Aranha no Aranhaverso'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 7 - Diretores
$app->get('/filmes/diretores', function ($request, $response) {
    $dados = [
        'diretores' => [
            'Christopher Nolan',
            'Steven Spielberg',
            'James Cameron'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 8 - Anos
$app->get('/filmes/anos', function ($request, $response) {
    $dados = [
        'filmes' => [
            [
                'titulo' => 'Interestelar',
                'ano' => 2014
            ],
            [
                'titulo' => 'Vingadores: Ultimato',
                'ano' => 2019
            ],
            [
                'titulo' => 'Toy Story',
                'ano' => 1995
            ]
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 9 - Notas
$app->get('/filmes/notas', function ($request, $response) {
    $dados = [
        'filmes' => [
            [
                'titulo' => 'Interestelar',
                'nota' => 9.0
            ],
            [
                'titulo' => 'Vingadores: Ultimato',
                'nota' => 8.4
            ],
            [
                'titulo' => 'Toy Story',
                'nota' => 8.3
            ]
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// 10 - Plataformas
$app->get('/filmes/plataformas', function ($request, $response) {
    $dados = [
        'plataformas' => [
            'Netflix',
            'Prime Video',
            'Disney+',
            'Max'
        ]
    ];

    $response->getBody()->write(json_encode($dados));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();