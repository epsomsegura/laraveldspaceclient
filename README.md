# Laravel DSpace 7 client

This is a Laravel Dspace7 client to manage dublin core metadata between platforms. 

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
This variables makes plugin can connect to DSpace 7 backend and make requests to its API.

___

<small>
Authors: 

**Epsom Segura**:  [[Website](https://epsomsegura.com)]  |  [[LinkedIn](https://www.linkedin.com/in/epsomsegura)]  |  [[Facebook](https://www.facebook.com/EpsomSegura/)]   |  [[YouTube](https://www.youtube.com/@epsomsegura)] 

**eScire**: [[Website](https://www.escire.lat)]  |  [[LinkedIn](https://www.linkedin.com/company/escire/mycompany/)]  |  [[Facebook](https://www.facebook.com/esciremx)]  |  [[YouTube](https://www.youtube.com/@escire6223)]
</small>