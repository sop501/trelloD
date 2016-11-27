<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Boards Controller
 *
 * @property \App\Model\Table\BoardsTable $Boards
 */
class BoardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Teams']
        ];
        $boards = $this->paginate($this->Boards);

        $this->set(compact('boards'));
        $this->set('_serialize', ['boards']);
    }

    /**
     * View method
     *
     * @param string|null $id Board id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $board = $this->Boards->get($id, [
            'contain' => ['Teams', 'Tasks']
        ]);

        $this->set('board', $board);
        $this->set('_serialize', ['board']);
    }
    public function complete($id = null)
    {
		$board = $this->Boards->get($id, [
            'contain' => []
        ]);
		$board['completed'] = 1;
       
            if ($this->Boards->save($task)) {
                $this->Flash->success(__('The board has been marked as completed.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The board could not be marked as completed. Please, try again.'));
            }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $board = $this->Boards->newEntity();
        if ($this->request->is('post')) {
			$this->request->data['created_by'] = $this->Auth->user('id');
            $board = $this->Boards->patchEntity($board, $this->request->data);
            if ($this->Boards->save($board)) {
                $this->Flash->success(__('The board has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The board could not be saved. Please, try again.'));
            }
        }
        $teams = $this->Boards->Teams->find('list', ['limit' => 200]);
        $this->set(compact('board', 'teams'));
        $this->set('_serialize', ['board']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Board id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $board = $this->Boards->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $board = $this->Boards->patchEntity($board, $this->request->data);
            if ($this->Boards->save($board)) {
                $this->Flash->success(__('The board has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The board could not be saved. Please, try again.'));
            }
        }
        $teams = $this->Boards->Teams->find('list', ['limit' => 200]);
        $this->set(compact('board', 'teams'));
        $this->set('_serialize', ['board']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Board id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $board = $this->Boards->get($id);
        if ($this->Boards->delete($board)) {
            $this->Flash->success(__('The board has been deleted.'));
        } else {
            $this->Flash->error(__('The board could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function isAuthorized($user)
{
    $action = $this->request->params['action'];

    // The add and index actions are always allowed.
    if (in_array($action, ['index', 'add'])) {
        return true;
    }
    // All other actions require an id.
    if (empty($this->request->params['pass'][0])) {
        return false;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $boardId = (int) $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($boardId, $user['id'])) {
            return true;
        }
    }

    
   // $id = $this->request->params['pass'][0];
    //$bookmark = $this->Bookmarks->get($id);
    //if ($bookmark->user_id == $user['id']) {
        //return true;
   // }
    return parent::isAuthorized($user);
}
}
