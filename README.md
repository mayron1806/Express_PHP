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
    
    $app = new Express();
    $app->get("/", "IndexController", "index");

    $app->setControllersPath("MyApp\\Controllers\\");

    $app->listen();
```
* Agora e so iniciar um servidor php e ver a magia acontecer.

---
## Como funciona o ExpressPHP
O ExpressPHP funciona basicamente com duas classes a Express e a Router.

 ### ***A classe Express*** 
Ela é a classe principal, nela está basicamente o coração do ExpressPHP nela você encontra 4 métodos são eles:
* ***setControllersPath***: recebe uma string com o caminho onde estão os namespaces do projeto.
* ***getUrl***: retorna o path da url que está sendo acessada atualmente.
* ***get***: adiciona a rota ao Express.
* ***listen***: ele basicamente é responsavél por chamar o metodo que vai iniciar os serviços.

 ### ***A classe Router***
Está classe apresenta apenas um metódo, o "**run**". Ele é responsavel por iniciar os servicos, ele pega a url atual, compara com as rotas do express e redireciona o usuario para o devido controlador.

Além dessas duas classes existe mais uma, a "**Route**", ela é um objeto com as propriedades de uma rota

| Propriedade | Funcionalidade | Tipo |
|---|---|---|
| **route** | a rota que voce deseja criar. | string |
| **controller** | o controlador daquela rota. | string |
| **action** | o metodo que representa aquela rota dentro do seu respectivo controlador. | string |

---

## Requisitos
Versão 8.0 ou superior do php.
