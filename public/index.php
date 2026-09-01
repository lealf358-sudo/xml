<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addBodyParsingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Função para transformar array em XML
function arrayToXml($dados, &$xml)
{
    foreach ($dados as $chave => $valor) {

        // Se for uma lista
        if (is_array($valor) && array_keys($valor) === range(0, count($valor) - 1)) {

            foreach ($valor as $item) {

                if (is_array($item)) {
                    $itemXml = $xml->addChild('item');
                    arrayToXml($item, $itemXml);
                } else {
                    $xml->addChild('item', htmlspecialchars($item));
                }
            }

        } elseif (is_array($valor)) {

            $novoXml = $xml->addChild($chave);
            arrayToXml($valor, $novoXml);

        } else {

            $xml->addChild($chave, htmlspecialchars((string)$valor));
        }
    }
}

// 1 - Status
$app->get('/status', function ($request, $response) {

    $dados = [
        'status' => 'online',
        'mensagem' => 'API funcionando corretamente'
    ];

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
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

    $xml = new SimpleXMLElement('<resposta/>');
    arrayToXml($dados, $xml);

    $response->getBody()->write($xml->asXML());

    return $response
        ->withHeader('Content-Type', 'application/xml')
        ->withStatus(200);
});
$produtos = [
    [
        'id' => 1,
        'nome' => 'Notebook'
    ]
];

$app->get('/produtos/{id}', function ($request, $response, $args) use (&$produtos) {

    $id = (int) $args['id'];

    foreach ($produtos as $produto) {
        if ($produto['id'] == $id) {

            $response->getBody()->write(json_encode($produto));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
    }

    $response->getBody()->write(
        json_encode(['erro' => 'Produto não encontrado'])
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->post('/produtos', function ($request, $response) use (&$produtos) {

    $dados = $request->getParsedBody();

    $novoProduto = [
        'id' => count($produtos) + 1,
        'nome' => $dados['nome']
    ];

    $produtos[] = $novoProduto;

    $response->getBody()->write(json_encode($novoProduto));

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});
$app->run();