<?php

namespace App\Controller\Component;
use Cake\Controller\Component;

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
        return file_exists(ROOT.'/vendor/pentaho/data-integration/kitchen.sh');
    }

    public function mysqlConnectorInstalled(){
        return file_exists(ROOT.'/vendor/pentaho/data-integration/lib/mysql-connector-java-5.1.38-bin.jar');
    }

    public function logsKitchenDirectoryExistsAndIsWritable(){
        if (!file_exists(LOGS.'kitchen')) {
            mkdir(LOGS.'kitchen', 0777, true);
        }
        return is_writable(LOGS.'kitchen');
    }

}