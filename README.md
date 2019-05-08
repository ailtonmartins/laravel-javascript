# Laravel + Javascript
  API - COMANDO
  
    Passo 1 
    cd api
    
    Passo 2      
    COMPOSER INSTALL
    
    Passo 3
        Altere o arquivo .env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=todobit
        DB_USERNAME=root
        DB_PASSWORD=root 

     Passo 4
     php artisan migrate:refresh --seed

     passo 5
     php artisan serve

   WEB - COMANDO
   
   passo 1
   cd web

   Passo 2      
   Verificar se o caminho do servidor api esta correto no arquivo js/app.js , caminho default é 'http://localhost:8000/api'

   Passo 3
   Rodar o comando http-serve se tiver instalador ou apenas abrir index.html no browser
