# Controle de Inventário

[![english_version](https://img.shields.io/badge/english_version-0A3161)](https://github.com/gsilverio7/controle-de-estoque#readme-title)

## Sobre

Inventory control system created with Laravel 5.6, JQuery and MySQL, using adminLTE package frontend assets.

## Funcionalidades

- Register simple and composite products. Usually, composite products are made from two or more simples products.

![produtos_simples](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/produtos_simples.png)
![produtos_compostos](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/produtos_compostos.png)

- Create buy or sell requests from the products registered.

![requisicao](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/requisicao.png)

- See the financial balance from these requests.

![movimentacoes](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/movimentacoes.png)

- See the inventory balance from these requests.
- Register clients.
- Create new users.

## Instruções de Instalação

1. Clone the repository into your machine
2. Clone the .env file without the '.example' and change it according to your database config
3. Run php artisan migrate --seed
4. Run composer install
5. Run npm install 
6. Run php artisan serve

Note that you need to have Composer 2.*, php 7.4, Node.js 14.15 installed in your machine, and a server of either MySql or Maria DB

## Credenciais de Administrador

Login: admin@mail.com  
Password: 147258

## Capturas de Tela

![login](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/login.png)
![dashboard](https://github.com/gsilverio7/controle-de-estoque/blob/main/screenshots/dashboard.png)

