<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
	       $this->CasAuth->allow('index', 'all', 'download');
	}

/**
 * index method
 *
 * @return void
 */

        public function all(){
                $this->layout = null ;
		$options = array('conditions' => array('Event.end > NOW()' ));
                $this->set('events', $this->Event->find('all', $options));
        }
        
        
    
        
/**
 * download method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function download($id = null) {
                $this->layout = null ;
                if($id == null){
                    $options = array('conditions' => array('Event.end > NOW()' ));
                    $this->set('events', $this->Event->find('all', $options));
                }
                else {
                    if (!$this->Event->exists($id)) {
                        throw new NotFoundException(__('Invalid event'));
                    }
                    $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
                    $event = $this->Event->find('first', $options);
                    $events = array();
                    array_push($events, $event);
                    $this->set('events', $events);
                }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

	/** 
	DESCRIPTION ON FORWARDING CAKE PHP DATA ENTRIES TO OTHER DATABASE or TABLE	
		    CakePhp makes it easy to switch the database you are working with, all that is necesary is to navigate to:
		    	    /app/core/database.php 
		    and change the login, datasource, login, password and database to the desired settings.			

		    Changeing the table to which one is sending and recieving data is not as fast but is fairly straightforward.
		    say you were to change to a table named 'quests' you would have to modify the following items:
		    	- EventsController.php 
			- Event.php model
			- View/Events folder and all its files
		    in these files every instace of the word event would have to be changed to quest (case kept constant, event->quest, Event->Quest)
		       	     	   	 	    	     	   	      	    	       	     (plural stays plural, events -> quests)
	**/


            pr($this->request->data);
            if ($this->request->is('post')) {
                $this->Event->create();
                //add pic
                $this->request->data['Event']=$this->request->data;
                //if(array_key_exists('error', $picture) && array_key_exists('error', $picture) && !($this->request->data['Event']['picture']['error']==4)){
                    //picture upload errors are caught here
                    if($this->request->data['Event']['picture']["error"] > 0){
                        if($this->request->data['picture']["error"] != 4){
                            return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
                        }else{
                             $this->request->data['Event']['picture'] = "";
                        }
                    }else{
                            $picture = $this->request->data['Event']['picture'];
                            // rounding up and throwing out invalid file types
                            if(1 > preg_match( '/.jpg$|.jpeg$|.gif$|.png$|.tif$/', $picture["name"])){
                                    $this->Session->setFlash(__('Invalid picture file type, please use jgp or png.'));
                                    return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
                            }
                            // preventing duplicate file names
                            if (file_exists(WWW_ROOT.'img/upload/'.$picture["name"])){
                                $this->Session->setFlash(__('The picture '.$picture["name"].' already exists.  '. WWW_ROOT));
                                return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
                            }
                            //lets upload that pic!
                            else{
                                //get properties
                                $file_name = $picture['name'];
                                //$file_size = $picture['size'];
                                //$file_ext = pathinfo($picture['name'], PATHINFO_EXTENSION);

                                // Upload Pic
                                move_uploaded_file($picture["tmp_name"],
                                    WWW_ROOT.'img/upload/'.$picture["name"]);

                                // get appropriate picture filename+path to save in DB
                                $this->request->data['Event']['picture'] = 'upload/'.$file_name;
                            }
                        }
		    // Cool, now lets make the poc the user's umd directory id
		    $this->request->data['Event']['point_of_contact'] = phpCAS::getUser();
                    //Now its time to save the event
                    if ($this->Event->save($this->request->data)) {
                            $this->Session->setFlash(__('The event has been saved.'));
                            return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The event could not be saved. Please, try again.'));
                            return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
                    }
                }
                return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
            }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if(!($this->Event->field('id', array('id' => $id, 'point_of_contact' => phpCAS::getUser())) == $id)){
			$this->Session->setFlash(__('You must own event in order to edit it'));
			return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
		}
		if (!$this->Event->exists($id)) {
		   	$this->Session->setFlash(__('Invalid event specified'));
			return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) { 
		    // Cool, now lets make the poc the user's umd directory id
		    $this->request->data['Event']['point_of_contact'] = phpCAS::getUser();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
				return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
			return ;
		}
		   	$this->Session->setFlash(__('Invalid event specified'));
			return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
	       	$this->Event->id = $id;
		if(!($this->Event->field('id', array('id' => $id, 'point_of_contact' => phpCAS::getUser())) == $id)){
			$this->Session->setFlash(__('You must own event in order to delete it'));
			return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
		}
		if (!$this->Event->exists()) {
			$this->Session->setFlash(__('Invalid event specified'));
			return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		// retrieve file to delete
		$delete_pic = $this->Event->find('first', array('conditions' => array('Event.id' => $id)));
		$file = new File(WWW_ROOT.'img/'.$delete_pic['Event']['picture']);
		if ($this->Event->delete()) {
		   	$file->delete();
			$this->Session->setFlash(__('The event has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
		}
                return $this->redirect(array('controller' => 'Editor', 'action' => 'index'));
	}}
