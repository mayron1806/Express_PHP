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

* Adicione o namespace do seu projeto ao autoload do composer 

```
"autoload": {
    "psr-4": {
        "MyApp\\" : "MyApp/"
    }
}
```

* Crie a pasta para receber o namespace do seu projeto e dentro dela cria uma pasta com o nome "controllers", dentro dela ficarão seus controladores que serão responsáveis pelas paginas de cada uma de suas rotas.
* Depois disso dentro da pasta controllers crie um arquivo chamado "IndexController.php" e nele coloque o codigo abaixo.

```php
<?php
    namespace MyApp\Controllers;

    class IndexController{
        public function index(){
            echo "Olá mundo!";
        }
    }
```

* Após tudo isso, é hora de criar o nosso script principal o "index.php". Dentro dele você deve colocar o codigo a seguir.

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

## Requisitos
Versão 8.0 ou superior do php.
