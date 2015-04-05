<?php


namespace convercity\Helpers;


use convercity\Table;

class Datalogger {

    static function createDataTable($name)
    {
        $tablename = 'datalogger_' . Datalogger::cleanName($name);
        if(! \DB::table($tablename)->exists())
        {
            Schema::create($tablename, function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('citizen_id')->unsigned();
                $table->foreign('citizen_id')->references('id')->on('citizens')->onDelete('cascade');
            });

            Table::create(['name' => $name, 'db_name' => $tablename]);
        }
        else
        {
            return false;
        }
    }

    public function createDataField($table, $field, $fieldType)
    {
        $fieldName = Datalogger::cleanName($field);
        if(\DB::table($table)->exists()
            && !\DB::table($table)->($fieldName)->exists())
        {
            Schema::table($table, function(Blueprint $table, $fieldName, $fieldType)
            {
                if($fieldType == 'string') {$table->string($fieldName);}
                if($fieldType == 'integer') {$table->integer($fieldName);}
                if($fieldType == 'text') {$table->text($fieldName);}
                if($fieldType == 'datatime') {$table->datetime($fieldName);}
            });
        }
    }

    /**
     * @param $name
     * @return string
     */
    protected function cleanName($name)
    {
        $cleanName = strtolower(str_replace(' ', '_', (preg_replace('/[^a-zA-Z0-9_ -%][().][\/]/s', '', $name))));

        return $cleanName;

    }

}