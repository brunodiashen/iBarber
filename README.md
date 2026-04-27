<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Executar o projeto

Na raiz do projeto execute os comandos no arquivo start.sh

Apos Executar os comandos separadamente e tudo der certo, abra o navegador e digite localhost:5173 para abir a pagina

## Tecnologias

Frontend: VueJS 3/Typescript <br>
Backend: Laravel 12/php8.2 <br>
Banco de dados: PostgreSQL, Redis <br>
Bibliotecas: 
- Frontend:
    - Axios: pacote para consumo de API
    - Bootstrap: Framework CSS
    - Pinia: Gestor de estado global
    - v-calendar: lib para calendario
    - vue-router: Gestor de rotas/paginas
    - vue3-smooth-scroll: Suavizador de deslize da pagina automatica
    - eslint: Analizador de codigo
    - Vite: Compilador de codigo
- Backend:
    - laravel/sanctum: Token de autenticacao com escopo
    - laravel/breeze: Starter kit oficial para implementar autenticação no Laravel
    - laravel/sail: Lib para utilizar imagens Docker prontas 
    - pestphp/pest: Lib para testes

## Estruturacao

- Frontend: 
    - Projeto estruturado em componentes independentes atravez do gestor de estado global (pinia) tendo suas funcoes separadas por arquivos
    - Projeto inicialmente criado na versao 2 do framework e atualmente atualizando utilizando as novas tecnologias
    - Pastas:
        - /src: arquivos do projeto
        - /assets: arquivos de imagem do projeto
        - /components: componentes html do projeto
        - /components/shared: componentes html compartilhados dentro do projeto
        - /core: arquivos typescript compartilhados
        - /router: rotas/paginas no frontend
        - /stores: arquivos de estado compartilhado
        - /templates: components html reutilizaveis
        - /views: Paginas do projeto
        - App.vue: componente root do projeto
        - main.ts: arquivo startup do projeto

- Backend:
    - Projeto utilizando apenas uma camada de execucao colocando o codigo diretamente no controller por ter a logica simples e ser projeto de estudo/pratica podendo ser expandido para Services e Repository futuramente
    - Utilizando o banco PostgreSQL para armazenamento de dados e Redis para dados temporarios que sera implementado juntamente com o processamento em fila Queue
    - Criado em versao mais antiga do laravel e atualizado para a versao 12 e php 8
