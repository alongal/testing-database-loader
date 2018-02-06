
Testing Database Loader
=========================

This is a simple class that loads an entire sql dump file into your required database.

How To Use
----------

```php
    $db = (new \alongal\ImportDb([
            'path_to_mysql_engine' => '/Applications/XAMPP/xamppfiles/bin/mysql',
            'path_to_file_to_load_folder' => realpath(__DIR__ . '/..') . '/tests/',
            'db_name' => 'test_db',
        ]))
            ->setDebugMode(false)
            ->dropDbIfExists(true)
            ->loadFile('test_db_001.sql');
```

----------
Feel free to contact me: alondagal@gmail.com or  [@galalon2](https://twitter.com/galalon2)