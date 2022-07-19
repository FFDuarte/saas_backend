# Rodar servidor 
php -S 0.0.0.0:8000 -t public 

# Comandos para rodar migrations
# -------------------------------------
# Para criar as migrations da tabela tenant /database/tenant
php artisan migrate --path=database/migrations/tenant
# Para criar as migrations da tabela admin /database/admin
php artisan migrate --path=database/migrations/admin
# Para rodas as migrations da paste default /database/migrations
php artisan migrate 


# Para executar rollback 
php artisan migrate:rollback colcoar --path se tiver
