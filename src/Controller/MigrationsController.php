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

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\SystemChecksComponent;
use App\Model\Table\MigrationsTable;
use Cake\Core\App;

/**
 * Migrations Controller
 *
 * @property MigrationsTable $Migrations
 * @property ScenariosTable $Scenarios
 */
class MigrationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('SystemChecks');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Scenarios'],
            'order' => ['id' => 'DESC']
        ];
        $this->set('migrations', $this->paginate($this->Migrations));
        $this->set('_serialize', ['migrations']);
    }

    /**
     * View method
     *
     * @param string|null $id Migration id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $execLines = $this->Migrations->getExecLine($id, false);
        $migration = $this->Migrations->get($id, [
            'contain' => ['Scenarios','Scenarios.Parameters', 'Scenarios.Tasks.Parameters']
        ]);
        $migrationsParameters = $this->Migrations->MigrationsParameters->find('list', [
            'keyField' => 'parameter_id',
            'valueField' => 'value',
            'groupField' => 'task_id'
        ])->where([
            'MigrationsParameters.migration_id' => $id
        ])->toArray();
        $migrationsParametersId = $this->Migrations->MigrationsParameters->find('list', [
            'keyField' => 'parameter_id',
            'valueField' => 'id',
            'groupField' => 'task_id'
        ])->where([
            'MigrationsParameters.migration_id' => $id
        ])->toArray();
        $this->set(compact('migration','migrationsParameters','migrationsParametersId','execLines'));
        $this->set('_serialize', ['migration']);
    }

    /**
     * Add method
     *
     */
    public function add()
    {
        $migration = $this->Migrations->newEntity();
        if ($this->request->is('post')) {
            $migration = $this->Migrations->patchEntity($migration, $this->request->data);
            if ($this->Migrations->save($migration)) {
                $this->Flash->success(__('The migration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migration could not be saved. Please, try again.'));
            }
        }
        $scenarios = $this->Migrations->Scenarios->find('list', ['limit' => 200]);
        $this->set(compact('migration', 'scenarios'));
        $this->set('_serialize', ['migration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Migration id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $migration = $this->Migrations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $migration = $this->Migrations->patchEntity($migration, $this->request->data);
            if ($this->Migrations->save($migration)) {
                $this->Flash->success(__('The migration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The migration could not be saved. Please, try again.'));
            }
        }
        $scenarios = $this->Migrations->Scenarios->find('list', ['limit' => 200]);
        $this->set(compact('migration', 'scenarios'));
        $this->set('_serialize', ['migration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Migration id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $migration = $this->Migrations->get($id);
        if ($this->Migrations->delete($migration)) {
            $this->Flash->success(__('The migration has been deleted.'));
        } else {
            $this->Flash->error(__('The migration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function check($id = null, $task_id = null, $check = null){

        switch ($check) {
            case "java":
                if($this->SystemChecks->javaInstalled()){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; Le binaire exécutable <code>java</code> est présent sur le système.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 1 — Le binaire exécutable <code>java</code> n\'est pas présent sur le système.';
                }
                break;
            case "pentaho":
                if($this->SystemChecks->pentahoInstalled()){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; Le script shell <code>kitchen.sh</code> (Pentaho Data Integration) est présent sur le système.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 2 — Le script shell <code>kitchen.sh</code> (Pentaho Data Integration) n\'est pas présent sur le système.';
                }
                break;
            case "mysql":
                if($this->SystemChecks->mysqlConnectorInstalled()){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; L\'archive java <code>mysql-connector-java-5.1.38-bin.jar</code> (MySQL Connector/J) est présente sur le système.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 3 — L\'archive java <code>mysql-connector-java-5.1.38-bin.jar</code> (MySQL Connector/J) n\'est pas présente sur le système.';
                }
                break;
            case "logs":
                if($this->SystemChecks->logsKitchenDirectoryExistsAndIsWritable()){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; Le répertoire <code>logs/kitchen</code> est présent et inscriptible.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 4 — Le répertoire <code>logs/kitchen</code> n\'est pas présent et/ou inscriptible.';
                }
                break;
            case "running":
                if($this->noTaskRunningForMigrationId($id)){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; Aucune tâche déjà en cours d\'exécution pour cette migration.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 5 — Une tâche est déjà en cours d\'exécution pour cette migration.';
                }
                break;
            case "scenario-parameters":
                if($this->Migrations->allScenarioParametersFilled($id)){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; L\'ensemble des paramètres liés au scénario associé à la migration sont renseignés.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 5 — L\'ensemble des paramètres liés au scénario associé à la migration ne sont pas renseignés.';
                }
                break;
            case "kjb":
                if($this->SystemChecks->kjbExists($task_id)){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; Le fichier de tâche <code>.kjb</code> (Pentaho Data Integration) associé à la tâche courante est présent et valide.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 7 — Le fichier de tâche <code>.kjb</code> (Pentaho Data Integration) associé à la tâche courante n\'est pas présent ou est invalide.';
                }
                break;
            case "requirement":
                if($this->requirementTaskIsSuccessfull($id, $task_id)){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; La tâche spécifiée le cas échéant en prérequis de la tâche courante est en succès.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 8 — La tâche spécifiée en prérequis de la tâche courante est en échec ou n\'a pas été lancée.';
                }
                break;
            case "task-parameters":
                if($this->Migrations->Scenarios->Tasks->allTaskParametersFilled($id, $task_id)){
                    echo '<i class="fa fa-check-circle fa-lg" style="color:green;"></i> &nbsp; L\'ensemble des paramètres liés à la tâche courante sont renseignés.';
                }else{
                    echo '<i class="fa fa-times-circle fa-lg" style="color:red;"></i> &nbsp; err. 9 — L\'ensemble des paramètres liés à la tâche courante ne sont pas renseignés.';
                }
                break;
        }
        exit;
    }

    public function requirements($id = null, $task_id = null){
        $this->set('id',$id);
        $this->set('task_id',$task_id);
    }

    public function run($id = null, $task_id = null){
        if( $this->SystemChecks->javaInstalled() &&
            $this->SystemChecks->pentahoInstalled() &&
            $this->SystemChecks->mysqlConnectorInstalled() &&
            $this->SystemChecks->logsKitchenDirectoryExistsAndIsWritable() &&
            $this->noTaskRunningForMigrationId($id) &&
            $this->Migrations->allScenarioParametersFilled($id) &&
            $this->SystemChecks->kjbExists($task_id) &&
            $this->requirementTaskIsSuccessfull($id, $task_id) &&
            $this->Migrations->Scenarios->Tasks->allTaskParametersFilled($id, $task_id)
        ){
            //exec('export LANG=en_US');
            exec($this->Migrations->getExecLine($id)[$task_id]);
            return $this->redirect(['action' => 'viewLog', $id, $task_id]);
        }else{
            return $this->redirect(['action' => 'requirements', $id, $task_id]);
        }
    }



    public function getPieceOfLog($id = null, $task_id = null){
        $session = $this->request->session();
        //$session->delete('Logfile.offset');
        header('Content-Type: text/plain');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        if (file_exists(LOGS.'kitchen/'.$id.'_'.$task_id.'.log')) {
            $handle = fopen(LOGS.'kitchen/'.$id.'_'.$task_id.'.log', 'r');
            if ($session->check('Logfile.offset')) {
                $data = stream_get_contents($handle, -1, $session->read('Logfile.offset'));
            } else {
                $data = stream_get_contents($handle, -1);
            }
            $session->write('Logfile.offset', ftell($handle));
            $highlighted_data = preg_replace('/(\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}:\d{2})/','<span class="blue">$1</span>',$data);
            $highlighted_data = preg_replace('/((?:.* - Kitchen - Finished!.*))/','<span class="done">$1</span>',$highlighted_data);
            $highlighted_data = preg_replace('/((?:.* - Kitchen - Fin !.*))/','<span class="done">$1</span>',$highlighted_data);

            $highlighted_data = preg_replace('/^(([a-zA-Z]|\t).*)$/m','<span class="red">$1</span>',$highlighted_data);

            preg_match_all('/.*( - .* - )(?:ERROR).*/',$data,$matches);
            $errors = array_unique($matches[1]);

            foreach($errors as $error){
                $highlighted_data = preg_replace('/((?:.*'.str_replace('/','\/',$error).'.*))/','<span class="red">$1</span>',$highlighted_data);
            }

            echo $highlighted_data;
        }
        exit;
    }

    public function viewLog($id = null, $task_id = null){
        if(file_exists(LOGS.'kitchen/'.$id.'_'.$task_id.'.log')){
            $session = $this->request->session();
            $session->delete('Logfile.offset');
            $this->set(compact('id','task_id'));
        }else{
            $this->Flash->error(__('Aucun fichier de trace existant pour cette tâche.'));
            return $this->redirect(['action' => 'view', $id]);
        }
    }

    private function taskIsRunning($id = null, $task_id = null){
        if (!file_exists(LOGS.'kitchen/'.$id.'_'.$task_id.'.pid')) {
            return false;
        }else{
            $pid = file_get_contents(LOGS.'kitchen/'.$id.'_'.$task_id.'.pid');

            $command = 'ps -p '.$pid;
            exec($command,$op);
            if (!isset($op[1]))return false;
            else return true;
        }
    }

    public function requirementTaskIsSuccessfull($id = null, $task_id = null){

        $task = $this->Migrations->Scenarios->Tasks->get($task_id, [
            'fields' => ['task_id']
        ]);

        if($task->task_id == 0){
            return true;
        }else{
            if(!file_exists(LOGS.'kitchen/'.$id.'_'.$task->task_id.'.log')){
                return false;
            }else{
                $logfile = file_get_contents(LOGS.'kitchen/'.$id.'_'.$task->task_id.'.log');
                $error = (strpos($logfile, 'ERROR')===false);
                return $error;
            }
        }
    }

    public function noTaskRunningForMigrationId($id = null){
        $isRunning = [];

        $migration = $this->Migrations->get($id, [
            'contain' => ['Scenarios.Tasks']
        ]);

        foreach($migration->scenario->tasks as $task){
            $isRunning[$task->id] = $this->taskIsRunning($id, $task->id);
        }

        if(in_array(true,$isRunning)){
            return false;
        }else{
            return true;
        }
    }
}
