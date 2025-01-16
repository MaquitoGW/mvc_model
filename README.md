A cada nova pasta de classes adicione no composer para o autoload carregar.
e atualize usando: composer dump-autoload
 

 Documentação
 Como criar uma rota?
 - No arquivo em routes/web.php instancie a rota
 
use lib\Routes;
$route = new Routes();

Depois insrirar seus tipos de rotas que são:

$route->get();
$route->post();

Explicando o metodo:
O primeiro parametro e o caminho da sua rota exemplo:

$route->get("home");

o segundo parametro e seu controlador

$route->get("home", [Site::class, "index"]);

Para criar seu controlador acesse /Controllers
e crie dessa maneira:

namespace Controllers;

class NomeDoControlador extends App {
}

Esse segundo parametro e uma array então e ele deve receber apenas dos valores
[A classe do controlado, e o metodo a chamar]

O terceiro parametro e para falar que ele não faz parte de um grupo então insirar
TRUE

Grupos:
Para se criar um grupo use:

$route->prefix("")->group(function ($e) {
});

O primeiro valor e se prefixo exemplo:

$route->prefix("teste");

depois chame o group e passe um parametro dsentro da função pode se usar qualquerl um mais iremos usar $e:

$route->prefix("teste")->group(function ($e) {
});

PAra chamr os metodos Post e Get use o parametro definido

$route->prefix("teste")->group(function ($e) {
    $e->get("maicon", [Site::class, "index2"]);
});

Sempre no final do arquivo finalize sua rota dessa maneira:
$route->exit();

Como usar os controladores:
Classe uteis:

Response : Com ela voce tem os metodos:
redirect(Passe a url que deseja usar)
back() volta para a pagina anterior, mais só se tiver usado redirect()
message("nome da mensagem", "valor da mensagem") Esse metodo cria uma mensagem e deve sempre ser usado em cadeamento com redirect ou back dessa maneira:
message()->redirect()
getMessage("nome da mensagem") Recuperar a message enviade, caso não exista retorna Null
abort("Codigo de erro", "messagem opcional") Isso retorna a pagina de erro com todos os erros existem defina apenas apenas o codigo
atributte("nome da query da url") caso sua url tenha parametros como ? ou &, passe apenas o nome

Todos esse metodos são estaticos então sempre use assim
Response::abort(405);

CAso queira personalizar a pagina de erro acesse
views/err.php

Para chamar sua pagina php dentro do seu controlador passe um return dessa maneira:

return Response::view("nome da sua pagina", [dentro dessa array passe suas variaveis]);

PAra criar sua pagina acesse:
views/

e crie um arquivo php exemplo:

index.php

e chame na view:
Response::view("index", [dentro dessa array passe suas variaveis])
caso esteja em pasta passe assim
Response::view("site.index", [dentro dessa array passe suas variaveis])