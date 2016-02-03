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

/**
 * ScenariosTasks Controller
 *
 * @property \App\Model\Table\ScenariosTasksTable $ScenariosTasks
 */
class ScenariosTasksController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Scenarios', 'Tasks']
        ];
        $this->set('scenariosTasks', $this->paginate($this->ScenariosTasks));
        $this->set('_serialize', ['scenariosTasks']);
    }

    /**
     * View method
     *
     * @param string|null $id Scenarios Task id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scenariosTask = $this->ScenariosTasks->get($id, [
            'contain' => ['Scenarios', 'Tasks']
        ]);
        $this->set('scenariosTask', $scenariosTask);
        $this->set('_serialize', ['scenariosTask']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scenariosTask = $this->ScenariosTasks->newEntity();
        if ($this->request->is('post')) {
            $scenariosTask = $this->ScenariosTasks->patchEntity($scenariosTask, $this->request->data);
            if ($this->ScenariosTasks->save($scenariosTask)) {
                $this->Flash->success(__('The scenarios task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scenarios task could not be saved. Please, try again.'));
            }
        }
        $scenarios = $this->ScenariosTasks->Scenarios->find('list', ['limit' => 200]);
        $tasks = $this->ScenariosTasks->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('scenariosTask', 'scenarios', 'tasks'));
        $this->set('_serialize', ['scenariosTask']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Scenarios Task id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $scenariosTask = $this->ScenariosTasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $scenariosTask = $this->ScenariosTasks->patchEntity($scenariosTask, $this->request->data);
            if ($this->ScenariosTasks->save($scenariosTask)) {
                $this->Flash->success(__('The scenarios task has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scenarios task could not be saved. Please, try again.'));
            }
        }
        $scenarios = $this->ScenariosTasks->Scenarios->find('list', ['limit' => 200]);
        $tasks = $this->ScenariosTasks->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('scenariosTask', 'scenarios', 'tasks'));
        $this->set('_serialize', ['scenariosTask']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Scenarios Task id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $scenariosTask = $this->ScenariosTasks->get($id);
        if ($this->ScenariosTasks->delete($scenariosTask)) {
            $this->Flash->success(__('The scenarios task has been deleted.'));
        } else {
            $this->Flash->error(__('The scenarios task could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
