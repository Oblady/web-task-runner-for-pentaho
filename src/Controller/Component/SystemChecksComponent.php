<?php
/**
 * This file is part of Web Task Runner for Pentaho Data Integration.
 *
 * Web Task Runner for Pentaho Data Integration is free software: you
 * can redistribute it and/or modify it under the terms of the GNU
 * Affero General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option)
 * any later version.
 *
 * Web Task Runner for Pentaho Data Integration is distributed in the
 * hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Affero General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */

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