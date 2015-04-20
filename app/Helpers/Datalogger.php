<?php


namespace convercity\Helpers;


use convercity\Field;
use convercity\Table;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Datalogger extends Migration {

    static function createDataTable($name)
    {
        $tableName = 'datalogger_' . Datalogger::cleanName($name);
        if(! Table::where('db_name')->exists() )
        {

            Schema::create($tableName, function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('citizen_id')->unsigned();
                $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
                $table->timestamps();
            });

            $table = Table::create(['name' => $name, 'db_name' => $tableName]);
            
            return $table;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param array $table
     * @return bool
     */
    static function createDataField($table)
    {
        $table = explode(',', $table);
        $field      = $table[1];
        $fieldType  = $table[2];
        $tableName      = Table::find($table[0])->db_name;
        $fieldName  = Datalogger::cleanName($field);

        if(!Field::where(['table_id' => $table[0], 'key' => $field])->exists() )
        {
            Schema::table($tableName, function(Blueprint $table) use ($fieldName, $fieldType)
            {
                $table->string($fieldName);
            });

            $field = Field::create(['name' => $field, 'key' => $fieldName, 'table_id' => $table[0], 'type' => $fieldType]);
            return $field;
        }

        return false;
    }

    /**
     * @param $name
     * @return string
     */
    static function cleanName($name)
    {
        $cleanName = strtolower(str_replace(' ', '_', (preg_replace('/[^a-zA-Z0-9_ -%][().][\/]/s', '', $name))));

        return $cleanName;

    }

}