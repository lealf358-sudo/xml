<?php
 
use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
 
class ProdutoTest extends TestCase
{
    public function testPostCriaProduto(): void
    {
        require __DIR__ . '/../src/app.php'; // retorna $app sem chamar ->run()
        $request = (new ServerRequestFactory())->createServerRequest('POST', '/produtos')
                                               ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode(['nome' => 'Mouse']));
        $request->getBody()->rewind();
        $response = $app->handle($request);
 
        $this->assertEquals(201, $response->getStatusCode());
        $corpo = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Mouse', $corpo['nome']);
    }

    public function testPostCriaProdutoComErro(): void
    {
        require __DIR__ . '/../src/app.php'; // retorna $app sem chamar ->run()
        $request = (new ServerRequestFactory())->createServerRequest('POST', '/produtos')
                                               ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode([]));
        $request->getBody()->rewind();
        $response = $app->handle($request);
 
        $this->assertEquals(400, $response->getStatusCode());
        $corpo = json_decode((string) $response->getBody(), true);
        $this->assertEquals('O nome é obrigatório', $corpo['erro']);
    }

    public function testGetCriaProduto(): void
    {
        require __DIR__ . '/../src/app.php'; // retorna $app sem chamar ->run()
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/produtos/1')
                                               ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode(['nome' => 'Notebook']));
        $request->getBody()->rewind();
        $response = $app->handle($request);
 
        $this->assertEquals(200, $response->getStatusCode());
        $corpo = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Notebook', $corpo['nome']);
    }

    public function testPutCriaProduto(): void
    {
        require __DIR__ . '/../src/app.php'; // retorna $app sem chamar ->run()
        $request = (new ServerRequestFactory())->createServerRequest('PUT', '/produtos/1')
                                               ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode(['nome' => 'Notebook']));
        $request->getBody()->rewind();
        $response = $app->handle($request);
 
        $this->assertEquals(200, $response->getStatusCode());
        $corpo = json_decode((string) $response->getBody(), true);
        $this->assertEquals('Notebook', $corpo['nome']);
    }

    public function testDeleteCriaProduto(): void
    {
        require __DIR__ . '/../src/app.php'; // retorna $app sem chamar ->run()
        $request = (new ServerRequestFactory())->createServerRequest('DELETE', '/produtos/1')
                                               ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode([]));
        $request->getBody()->rewind();
        $response = $app->handle($request);
 
        $this->assertEquals(204, $response->getStatusCode());
        //$corpo = json_decode((string) $response->getBody(), true);
        //$this->assertEquals('Notebook', $corpo['nome']);
    }
}
