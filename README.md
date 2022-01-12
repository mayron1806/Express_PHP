# **Express_PHP**
Um gerenciador de rotas para PHP baseado na sintaxe do Express (Node.js).

---

## Instalação
Para instalar cole o codigo abaixo no seu terminal (certifique-se de ter o composer instalado no seu computador).

```
composer require mayron1806/express_php
```

---

## Como usar

Para utilizar e necessario configurar os seus controladores. Para fazer isso siga os passos a seguir.
* Adicione o namespace do seu projeto ao autoload do composer, no seu composer.json.

```json
{
    "autoload": {
        "psr-4": {
            "MyApp\\" : "MyApp/"
        }
    }
}

```

* Crie a pasta para receber o namespace do seu projeto, no diretorio raiz do seu projeto e dentro dela cria uma pasta com o nome "**controllers**", dentro dela ficarão seus controladores que serão responsáveis pelas paginas de cada uma de suas rotas.
* Depois disso crie um arquivo dentro da pasta "**controllers**" chamado "**IndexController.php**" e nele coloque o codigo abaixo.

```php
<?php
    namespace MyApp\Controllers;

    class IndexController{
        public function index(){
            echo "Olá mundo!";
        }
    }
```

* Após tudo isso, é hora de criar o nosso script principal o "**index.php**" que vai ficar no diretorio raiz do projeto. Dentro dele você deve colocar o codigo a seguir.

```php
<?php
    require_once __DIR__. "/vendor/autoload.php";
    use ExpressPHP\Express\Express;
    
    $app = new Express("MyApp\\Controllers\\");

    $app->addRoute(route: "/", controller: "IndexController", action: "index",is_default_route: true);

    $app->listen();
```
* Agora e so iniciar um servidor php e ver a magia acontecer.

---
## Como funciona o ExpressPHP
O ExpressPHP funciona basicamente com uma classe a Express.

 ### ***A classe Express*** 
Ela é a classe principal, nela está basicamente o coração do ExpressPHP nela você encontra 5 métodos são eles:
* ***setControllersPath***: recebe uma string com o caminho onde estão os namespaces do projeto.
* ***getUrl***: retorna o path da url que está sendo acessada atualmente.
* ***addRoute***: adiciona rotas ao Express.
* ***listen***: ele basicamente é responsavél por chamar o metodo que vai iniciar os serviços.
* ***run***: ele inicia os serviços. Quando chamado o "run" compara a url atual com as rotas definidas, se a achar alguma que coincide com a url atual ele executa essa rota, se não encontrar ele executa a rota definida como padrão.

Além dessa classe existe mais uma, a "**Route**", ela é um objeto com as propriedades de uma rota. Abaixo você pode ver as propriedades dela.

| Propriedade | Funcionalidade | Tipo |
|---|---|---|
| **route** | a rota que voce deseja criar. | string |
| **controller** | o controlador daquela rota. | string |
| **action** | o metodo que representa aquela rota dentro do seu respectivo controlador. | string |

---

## Requisitos
Versão 8.0 ou superior do php.
