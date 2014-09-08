<?php
App::uses('AppController', 'Controller');
/**
 * Editor Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EditorController extends AppController {

	public function index() {
                $this->layout = null ;
	}
        
        
        public function logout() {
            return $this->redirect($this->CasAuth->logout());
        }
    
}
