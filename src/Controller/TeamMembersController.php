<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TeamMembers Controller
 *
 * @property \App\Model\Table\TeamMembersTable $TeamMembers
 */
class TeamMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Teams']
        ];
        $teamMembers = $this->paginate($this->TeamMembers);

        $this->set(compact('teamMembers'));
        $this->set('_serialize', ['teamMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teamMember = $this->TeamMembers->get($id, [
            'contain' => ['Users', 'Teams']
        ]);

        $this->set('teamMember', $teamMember);
        $this->set('_serialize', ['teamMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teamMember = $this->TeamMembers->newEntity();
        if ($this->request->is('post')) {
            $teamMember = $this->TeamMembers->patchEntity($teamMember, $this->request->data);
            if ($this->TeamMembers->save($teamMember)) {
                $this->Flash->success(__('The team member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The team member could not be saved. Please, try again.'));
            }
        }
        $users = $this->TeamMembers->Users->find('list', ['limit' => 200]);
        $teams = $this->TeamMembers->Teams->find('list', ['limit' => 200]);
        $this->set(compact('teamMember', 'users', 'teams'));
        $this->set('_serialize', ['teamMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teamMember = $this->TeamMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teamMember = $this->TeamMembers->patchEntity($teamMember, $this->request->data);
            if ($this->TeamMembers->save($teamMember)) {
                $this->Flash->success(__('The team member has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The team member could not be saved. Please, try again.'));
            }
        }
        $users = $this->TeamMembers->Users->find('list', ['limit' => 200]);
        $teams = $this->TeamMembers->Teams->find('list', ['limit' => 200]);
        $this->set(compact('teamMember', 'users', 'teams'));
        $this->set('_serialize', ['teamMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teamMember = $this->TeamMembers->get($id);
        if ($this->TeamMembers->delete($teamMember)) {
            $this->Flash->success(__('The team member has been deleted.'));
        } else {
            $this->Flash->error(__('The team member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
