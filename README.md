# cursoPHP
Curso Introducción a PHP

Para que funcionen las dependencias hay que ejecutar:
1. Composer Install
2. Eliminar : "psr/http-server-handler": "^1.0",
              "woohoolabs/harmony": "^6.1"
3. composer update
4. composer require --prefer-source psr/http-server-handler
5. composer require woohoolabs/harmony
