<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */

	public $helpers = array('Time');

	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */

	public function index() {
		$role = $this->Auth->user('role'); 
		$id = $this->Auth->user('id'); 

		if ($this->User->exists($id)) {
			if ($role=='admin') {
				$this->User->recursive = 0;
				$this->set('users', $this->Paginator->paginate());
			}
			if ($role=='contribuyente') {
				$this->redirect(array('controller' => 'users' , 'action' => 'view'."/".$id));
			}
		}else{
			throw new NotFoundException(__('Invalid user'));
		}
	}



/*	metodo index original
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}*/

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$idUsuario = $this->Auth->user('id');
		$role = $this->Auth->user('role'); 

		if ($role == 'contribuyente') {
			if($idUsuario != $id){
				$id = $this->Auth->user('id'); 
				return $this->redirect(array('controller' => 'users' , 'action' => 'view'."/".$id));
			}
		}

		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/*	funcion view original
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}*/

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role']='contribuyente';
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.' , 'default' , array('class' => 'alert alert-success' )));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$idUsuario = $this->Auth->user('id');
		$role = $this->Auth->user('role'); 

		if ($role == 'contribuyente') {
			if($idUsuario != $id){
				$id = $this->Auth->user('id'); 
				return $this->redirect(array('controller' => 'users' , 'action' => 'edit'."/".$id));
			}
		}


		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$idUsuario = $this->Auth->user('id');
		$role = $this->Auth->user('role'); 

		if ($role == 'contribuyente') {
			if($idUsuario != $id){
				$id = $this->Auth->user('id'); 
				return $this->redirect(array('controller' => 'users' , 'action' => 'view'."/".$id));
			}
		}

		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('add', 'logout');
	}



	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			}
		$this->Flash->error(__('Usuario o Contraseña Invalida, Intente de nuevo'));
		//$this->Session->setFlash('usuario o contraseña invalida intente de  nuevo', 'default', array('class' => 'alert alert-success'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

}
