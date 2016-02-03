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
 * Scenarios Controller
 *
 * @property \App\Model\Table\ScenariosTable $Scenarios
 */
class ScenariosController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('scenarios', $this->paginate($this->Scenarios));
        $this->set('_serialize', ['scenarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Scenario id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scenario = $this->Scenarios->get($id, [
            'contain' => ['Parameters', 'Tasks']
        ]);
        $this->set('scenario', $scenario);
        $this->set('_serialize', ['scenario']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $scenario = $this->Scenarios->newEntity();
        if ($this->request->is('post')) {
            $scenario = $this->Scenarios->patchEntity($scenario, $this->request->data);
            if ($this->Scenarios->save($scenario)) {
                $this->Flash->success(__('The scenario has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scenario could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->Scenarios->Parameters->find('list', ['limit' => 200]);
        $tasks = $this->Scenarios->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('scenario', 'parameters', 'tasks'));
        $this->set('_serialize', ['scenario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Scenario id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $scenario = $this->Scenarios->get($id, [
            'contain' => ['Parameters', 'Tasks']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $scenario = $this->Scenarios->patchEntity($scenario, $this->request->data);
            if ($this->Scenarios->save($scenario)) {
                $this->Flash->success(__('The scenario has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The scenario could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->Scenarios->Parameters->find('list', ['limit' => 200]);
        $tasks = $this->Scenarios->Tasks->find('list', ['limit' => 200]);
        $this->set(compact('scenario', 'parameters', 'tasks'));
        $this->set('_serialize', ['scenario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Scenario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $scenario = $this->Scenarios->get($id);
        if ($this->Scenarios->delete($scenario)) {
            $this->Flash->success(__('The scenario has been deleted.'));
        } else {
            $this->Flash->error(__('The scenario could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
