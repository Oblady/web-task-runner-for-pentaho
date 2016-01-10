<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ParametersScenarios Controller
 *
 * @property \App\Model\Table\ParametersScenariosTable $ParametersScenarios
 */
class ParametersScenariosController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Parameters', 'Scenarios']
        ];
        $this->set('parametersScenarios', $this->paginate($this->ParametersScenarios));
        $this->set('_serialize', ['parametersScenarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameters Scenario id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parametersScenario = $this->ParametersScenarios->get($id, [
            'contain' => ['Parameters', 'Scenarios']
        ]);
        $this->set('parametersScenario', $parametersScenario);
        $this->set('_serialize', ['parametersScenario']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $parametersScenario = $this->ParametersScenarios->newEntity();
        if ($this->request->is('post')) {
            $parametersScenario = $this->ParametersScenarios->patchEntity($parametersScenario, $this->request->data);
            if ($this->ParametersScenarios->save($parametersScenario)) {
                $this->Flash->success(__('The parameters scenario has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameters scenario could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->ParametersScenarios->Parameters->find('list', ['limit' => 200]);
        $scenarios = $this->ParametersScenarios->Scenarios->find('list', ['limit' => 200]);
        $this->set(compact('parametersScenario', 'parameters', 'scenarios'));
        $this->set('_serialize', ['parametersScenario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parameters Scenario id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $parametersScenario = $this->ParametersScenarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parametersScenario = $this->ParametersScenarios->patchEntity($parametersScenario, $this->request->data);
            if ($this->ParametersScenarios->save($parametersScenario)) {
                $this->Flash->success(__('The parameters scenario has been saved.'));
                if($this->request->query('redir_controller') !== null
                    && $this->request->query('redir_action') !== null
                    && $this->request->query('redir_param1') !== null){
                    return $this->redirect([
                        'controller' => $this->request->query('redir_controller'),
                        'action' => $this->request->query('redir_action'),
                        $this->request->query('redir_param1')
                    ]);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The parameters scenario could not be saved. Please, try again.'));
            }
        }
        $parameters = $this->ParametersScenarios->Parameters->find('list', ['limit' => 200]);
        $scenarios = $this->ParametersScenarios->Scenarios->find('list', ['limit' => 200]);
        $this->set(compact('parametersScenario', 'parameters', 'scenarios'));
        $this->set('_serialize', ['parametersScenario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parameters Scenario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parametersScenario = $this->ParametersScenarios->get($id);
        if ($this->ParametersScenarios->delete($parametersScenario)) {
            $this->Flash->success(__('The parameters scenario has been deleted.'));
        } else {
            $this->Flash->error(__('The parameters scenario could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
