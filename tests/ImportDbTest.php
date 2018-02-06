<?php

class ImportDbTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_requires_path_to_the_mysql_engine_path_to_the_file_to_load_folder_and_the_database_name_()
    {
        $db = new \alongal\ImportDb([
            'path_to_mysql_engine' => '/mysql',
            'path_to_file_to_load_folder' => '/tests/setup/',
            'db_name' => 'stampme__v2__test',
        ]);

        $this->assertEquals('/mysql -uroot stampme__v2__test < /tests/setup/', $db);
    }

    /** @test */
    function it_requires_name_of_sql_file_to_load()
    {
        $db = (new \alongal\ImportDb([
            'path_to_mysql_engine' => '/Applications/XAMPP/xamppfiles/bin/mysql',
            'path_to_file_to_load_folder' => realpath(__DIR__ . '/..') . '/tests/',
            'db_name' => 'test_db',
        ]))
            ->setDebugMode(true)
            ->dropDbIfExists(true)
            ->loadFile('test_db_001.sql');

        $this->assertEquals('/Applications/XAMPP/xamppfiles/bin/mysql -uroot test_db < /Applications/XAMPP/xamppfiles/htdocs/Code/my-composer-package/tests/test_db_001.sql', $db);
    }
}