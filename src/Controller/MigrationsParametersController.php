<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MigrationsParameters Controller
 *
 * @property \App\Model\Table\MigrationsParametersTable $MigrationsParameters
 */
class MigrationsParametersController extends AppController
{

    public function add(){
        $migrationsParameter = $this->MigrationsParameters->newEntity();
        if ($this->request->is('post')) {
            $migrationsParameter = $this->MigrationsParameters->patchEntity($migrationsParameter, $this->request->data);
            $migrationsParameter->set('migration_id',intval($this->request->query['migration_id']));
            $migrationsParameter->set('task_id',intval($this->request->query['task_id']));
            $migrationsParameter->set('parameter_id',intval($this->request->query['parameter_id']));
            if ($this->MigrationsParameters->save($migrationsParameter)) {
                $this->Flash->success(__('The migrations parameter has been saved.'));
                return $this->redirect(['controller'=>'migrations', 'action' => 'view', $this->request->query['migration_id']]);
            } else {
                $this->Flash->error(__('The migrations parameter could not be saved. Please, try again.'));
            }
        }
        $migrations = $this->MigrationsParameters->Migrations->find('list', ['limit' => 200]);
        $parameters = $this->MigrationsParameters->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('migrationsParameter', 'migrations', 'parameters'));
        $this->set('_serialize', ['migrationsParameter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Migrations Parameter id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $migrationsParameter = $this->MigrationsParameters->get($id,['contain' => ['Parameters', 'Migrations']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $migrationsParameter = $this->MigrationsParameters->patchEntity($migrationsParameter, $this->request->data);
            if ($this->MigrationsParameters->save($migrationsParameter)) {
                $this->Flash->success(__('The migrations parameter has been saved.'));
                return $this->redirect(['controller'=>'migrations', 'action' => 'view', $migrationsParameter->migration_id]);
            } else {
                $this->Flash->error(__('The migrations parameter could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('migrationsParameter'));
        $this->set('_serialize', ['migrationsParameter']);

    }

    /**
     * Delete method
     *
     * @param string|null $id Migrations Parameter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $migrationsParameter = $this->MigrationsParameters->get($id);
        if ($this->MigrationsParameters->delete($migrationsParameter)) {
            $this->Flash->success(__('The migrations parameter has been deleted.'));
        } else {
            $this->Flash->error(__('The migrations parameter could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
