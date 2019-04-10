# build containers
echo '==========================='
echo 'Building containers...'
echo '==========================='
docker-compose up -d --build
# install composer dependencies
echo '==========================='
echo 'Installing dependencies...'
echo '==========================='
docker-compose run -u www php composer install --prefer-dist --no-interaction
cp .env.example .env
# run migrations
echo '==========================='
echo 'Run migrations...'
echo '==========================='
docker-compose run php php artisan migrate
# run test
echo '==========================='
echo 'Run test and create coverage report...'
echo '==========================='
docker-compose run php vendor/bin/phpunit --coverage-html ./public/test