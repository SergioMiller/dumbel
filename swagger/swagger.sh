#!/bin/bash
#:set fileformat=unix
php ../vendor/bin/openapi --bootstrap ./swagger-constants.php --output ../public/swagger-assets ./swagger-v1.php ../app
