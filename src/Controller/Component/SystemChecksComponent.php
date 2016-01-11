<?php

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class SystemChecksComponent extends Component
{
    public function javaInstalled()
    {
        exec('which java',$result,$return_code);
        if($return_code == 0){
            return true;
        }else{
            return false;
        }
    }

    public function pentahoInstalled(){
        //Copy patched spoon.sh with -Dfile.encoding=UTF8 option
        copy(ROOT.'/config/spoon.sh',ROOT.'/vendor/pentaho/data-integration/spoon.sh');
        return file_exists(ROOT.'/vendor/pentaho/data-integration/kitchen.sh');
    }

    public function mysqlConnectorInstalled(){
        if (!file_exists(ROOT.'/vendor/pentaho/data-integration/lib/mysql-connector-java-5.1.38-bin.jar')) {
            copy(ROOT.'/vendor/mysql/mysql-connector-j/mysql-connector-java-5.1.38-bin.jar', ROOT.'/vendor/pentaho/data-integration/lib/mysql-connector-java-5.1.38-bin.jar');
        }
        return file_exists(ROOT.'/vendor/pentaho/data-integration/lib/mysql-connector-java-5.1.38-bin.jar');
    }

    public function logsKitchenDirectoryExistsAndIsWritable(){
        if (!file_exists(LOGS.'kitchen')) {
            mkdir(LOGS.'kitchen', 0777, true);
        }
        return is_writable(LOGS.'kitchen');
    }

    public function kjbExists($id = null){

        $table_tasks = TableRegistry::get('Tasks');
        $task = $table_tasks->get($id);

        if(file_exists($task->job_path) && mime_content_type($task->job_path) == "application/xml")
            return true;
        else
            return false;
    }
}