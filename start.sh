## Executar esses comandos fora do arquivo
# cp .env.example .env;
# docker compose up -d;
docker exec -it ibarber-laravel.test-1 /bin/bash;
composer install;
php artisan key:generate;
php artisan env:encrypt;
php artisan optimize;
php artisan migrate;
php artisan db:seed;
cd frontend;
npm install;
npm run dev;
