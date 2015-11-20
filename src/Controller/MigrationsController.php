<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Migrations Controller
 *
 * @property \App\Model\Table\MigrationsTable $Migrations
 */
class MigrationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Scenarios']
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
        $migration = $this->Migrations->find('all', [
            'contain' => ['Scenarios','Scenarios.Parameters', 'Scenarios.Tasks.Parameters', 'MigrationsParameters']
        ])->first();
        debug($migration);
        $this->set('migration', $migration);
        $this->set('_serialize', ['migration']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
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
     * @return void Redirects on successful edit, renders view otherwise.
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
}
