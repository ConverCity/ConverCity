<?php


namespace convercity\Helpers;


use convercity\Field;
use convercity\Table;
use convercity\Datamark;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Datalogger extends Migration {

    /*
    * Generate a new table and log its creation.
    *
    * @param string $name
    * 
    */

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
     * 
     * Generate field on custom table and log field generation
     * 
     * @param string $table
     * @return string
     */
    static function createDataField($table)
    {
        $table      = explode(',', $table);
        $field      = $table[1];
        $fieldType  = $table[2];
        $tableName  = Table::find($table[0])->db_name;
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
     * Clean proposed name and return clean name
     *
     * @param string $name
     * @return string
     */
    static function cleanName($name)
    {
        $cleanName = strtolower(str_replace(' ', '_', (preg_replace('/[^a-zA-Z0-9_ -%][().][\/]/s', '', $name))));

        return $cleanName;

    }

    /**
     *
     * Return array of datamarks related to a reply
     * or to a reply only to specific messages.
     *
     * @param int $reply, int $message
     * @return array
     */
    static function getDatamarks($reply, $message = null)
    {
        if($message)
        {
            $marks = Datamark::where('reply_id', $reply)->where('message_id', $message)->get();
        }
        else
        {
            $marks = Datamark::where('reply_id', $reply)->get();
        }

        return $marks;
    }

}