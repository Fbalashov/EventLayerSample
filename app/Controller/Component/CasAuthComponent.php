<?php  

App::import('Vendor', 'cas', array('file' => 'CAS-1.3.2'.DS.'CAS-1.3.2'.DS.'CAS.php')); 
App::import('Component', 'Auth'); 

/** 
 * CasAuthComponent by Pietro Brignola. 
 * 
 * Extend CakePHP AuthComponent providing authentication against CAS service. 
 * 
 * PHP versions 4 and 5 
 * 
 * Comments and bug reports welcome at pietro.brignola AT unipa DOT it 
 * 
 * Licensed under The MIT License 
 * 
 * @writtenby      Pietro Brignola 
 * @lastmodified   Date: October 12, 2010 
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License 
 */  
class CasAuthComponent extends AuthComponent { 
     
    /** 
     * Main execution method.  Initializes CAS client and force authentication if required before passing user to parent startup method.
     * 
     * @param object $controller A reference to the instantiating controller object 
     * @return boolean 
     * @access public 
     */ 
    function startup(Controller $controller) { 
    	//If user is alloed to access area it will allow them to proceed
	if($this->_isAllowed($controller)){
		return true;	
	}
        // CAS authentication required if user is not logged in  
        if (!$this->user()) { 
            // Set debug mode 
            phpCAS::setDebug(false); 
            //Initialize phpCAS 
            phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'), true);
            // No SSL validation for the CAS server 
            phpCAS::setNoCasServerValidation(); 
            // Force CAS authentication if required 
            phpCAS::forceAuthentication(); 
            //$model =& $this->getModel(); 
            //$controller->data[$model->alias][$this->fields['username']] = phpCAS::getUser(); 
            //$controller->data[$model->alias][$this->fields['password']] = ''; 
        } 
        return phpCAS::isAuthenticated();
    } 
     
    /** 
     * Logout execution method.  Initializes CAS client and force logout if required before returning to parent logout method.
     * 
     * @param mixed $url Optional URL to redirect the user to after logout 
     * @return string AuthComponent::$loginAction 
     * @see AuthComponent::$loginAction 
     * @access public 
     */ 
    function logout() { 
        // Set debug mode 
        //phpCAS::setDebug(false); 
        //Initialize phpCAS 
        //phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'), true);
        // No SSL validation for the CAS server 
        //phpCAS::setNoCasServerValidation(); 
        // Force CAS logout if required 
        if (phpCAS::isAuthenticated()) { 
            phpCAS::logout(array('url' => 'http://localhost/EventLayer')); // Provide login url for your application 
        } 
        return Router::normalize($this->logoutRedirect);//parent::logout(); 
    } 
     
} 

?>