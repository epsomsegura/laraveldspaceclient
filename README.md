# Laravel DSpace 7 client

## Installation
You can install this plugin using composer
~~~
composer require epsomsegura/laraveldspaceclient
~~~

## Seting up Laravel environment
You should add this variables with your DSpace 7 administration information into ***.env*** file
~~~
# DSpace admin email
DSPACE_API_EMAIL="admin@email.com"
# Dspace admin password
DSPACE_API_PASS="mystrongpassword"
# DSpace API URL base
DSPACE_API_URL="https://mydomain.com/server/api/"
# DSpace API domain
DSPACE_API_DOMAIN="mydomain.com"
~~~
This variables makes plugin can connecto to DSpace 7 backend and make requests to its API.