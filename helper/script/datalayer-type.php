<?php

use Elegance\Connection\Mysql;
use Elegance\Datalayer;

Datalayer::registerType('mysql', Mysql::class);