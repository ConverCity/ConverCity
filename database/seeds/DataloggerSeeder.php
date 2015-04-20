<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DataloggerSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \convercity\Table::truncate();

        $table = \convercity\Table::create([   'name'    => 'Test Table',
                                     'db_name'     => 'datalogger_test_table',
        ]);

        \convercity\Field::create([
            'name' => 'Test Field',
            'key' => 'test_field',
            'table_id' => $table->id
        ]);

    }

}
