<?php
namespace FreePBX\modules;
/*
 * Class stub for BMO Module class
 * In getActionbar change "modulename" to the display value for the page
 * In getActionbar change extdisplay to align with whatever variable you use to decide if the page is in edit mode.
 *
 */

 $setting = array('authenticate' => true, 'allowremote' => false);

class <%= name.charAt(0).toUpperCase() + name.slice(1) %> implements \BMO
{

    // Note that the default Constructor comes from BMO/Self_Helper.
    // You may override it here if you wish. By default every BMO
    // object, when created, is handed the FreePBX Singleton object.

    // Do not use these functions to reference a function that may not
    // exist yet - for example, if you add 'testFunction', it may not
    // be visibile in here, as the PREVIOUS Class may already be loaded.
    //
    // Use install.php or uninstall.php instead, which guarantee a new
    // instance of this object.
    public function install()
    {
    }
    public function uninstall()
    {
    }

    // The following two stubs are planned for implementation in FreePBX 15.
    public function backup()
    {
    }
    public function restore($backup)
    {
    }

    // http://wiki.freepbx.org/display/FOP/BMO+Hooks#BMOHooks-HTTPHooks(ConfigPageInits)
    //
    // This handles any data passed to this module before the page is rendered.
    public function doConfigPageInit($page) {
		$id = $_REQUEST['id']?$_REQUEST['id']:'';
		$action = $_REQUEST['action']?$_REQUEST['action']:'';
		$exampleField = $_REQUEST['example-field']?$_REQUEST['example-field']:'';
		//Handle form submissions
		switch ($action) {
			case 'add':
				$id = $this->addItem($exampleField,$body);
				$_REQUEST['id'] = $id;
			break;
			case 'edit':
				$this->updateItem($id,$exampleField,$body);
			break;
			case 'delete':
				$this->deleteItem($id);
				unset($_REQUEST['action']);
				unset($_REQUEST['id']);
			break;
		}
    }

    // http://wiki.freepbx.org/pages/viewpage.action?pageId=29753755
    public function getActionBar($request)
    {
        $buttons = array();
        switch ($request['display']) {
            case '<%= name %>':
                $buttons = array(
                    'delete' => array(
                        'name' => 'delete',
                        'id' => 'delete',
                        'value' => _('Delete')
                    ),
                    'reset' => array(
                        'name' => 'reset',
                        'id' => 'reset',
                        'value' => _('Reset')
                    ),
                    'submit' => array(
                        'name' => 'submit',
                        'id' => 'submit',
                        'value' => _('Submit')
                    )
                );
                if (empty($request['extdisplay'])) {
                    unset($buttons['delete']);
                }
            break;
        }
        return $buttons;
    }

    // http://wiki.freepbx.org/display/FOP/BMO+Ajax+Calls
    public function ajaxRequest($req, &$setting)
    {
        switch ($req) {
            case 'getJSON':
                return true;
            break;
            default:
                return false;
            break;
        }
    }

    // This is also documented at http://wiki.freepbx.org/display/FOP/BMO+Ajax+Calls
    public function ajaxHandler()
    {
        switch ($_REQUEST['command']) {
            case 'getJSON':
                switch ($_REQUEST['jdata']) {
                    case 'grid':
                        $ret = array();
                        /*code here to generate array*/
                        return $ret;
                    break;

                    default:
                        return false;
                    break;
                }
            break;

            default:
                return false;
            break;
        }
    }

    // http://wiki.freepbx.org/display/FOP/Adding+Floating+Right+Nav+to+Your+Module
    public function getRightNav($request)
    {
        $html = '<p>Custom HTML</p>';
        return $html;
    }

    // http://wiki.freepbx.org/display/FOP/HTML+Output+from+BMO
    public function showPage()
    {
		switch ($_REQUEST['view']) {
			case 'form':
				if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
					$subhead = _('Edit <%= description %>');
					$content = load_view(__DIR__.'/views/form.php', $this->getOne($_REQUEST['id']));
				}else{
					$subhead = _('Add <%= description %>');
					$content = load_view(__DIR__.'/views/form.php');
				}
			break;
			default:
				$subhead = _('<%= description %> List');
				$content = load_view(__DIR__.'/views/grid.php');
			break;
		}
		echo load_view(__DIR__.'/views/default.php', array('subhead' => $subhead, 'content' => $content));
	}

	/**
	 * getOne Gets an individual item by ID
	 */
	public function getOne($id){
		// $sql = "SELECT id,subject,body FROM helloworld WHERE id = :id";
		// $stmt = $this->db->prepare($sql);
		// $stmt->bindParam(':id',$id, \PDO::PARAM_INT);
		// $stmt->execute();
		// $row =$stmt->fetchObject();
		// return array(
		// 	'id' => $row->id,
		// 	'subject' => $row->subject,
		// 	'body' => $row->body
		// 	);
		return array();
	}
	/**
	 * getList gets a list od subjects and their respective id.
	 */
	public function getList(){
		$ret = array();
		// $sql = 'SELECT id,subject,body from helloworld';
		// foreach ($this->db->query($sql) as $row) {
		// 	$ret[] = array('id' => $row['id'],'subject' => $row['subject']);
		// }
		return $ret;
	}
	/**
	 * addItem Add an Item
	 */
	public function addItem($data){
		// 	$sql = 'INSERT INTO helloworld (subject, body) VALUES (:subject, :body)';
		// 	$stmt = $this->db->prepare($sql);
		// 	$stmt->bindParam(':subject', $data['subject'], \PDO::PARAM_STR);
		// 	$stmt->bindParam(':body', $data['body'], \PDO::PARAM_STR);
		// 	$stmt->execute();
		// 	return $this->db->lastInsertId();
		return true;
	}
	/**
	 * updateItem Updates the given ID
	 */
	public function updateItem($id,$data){
		// $sql = 'UPDATE helloworld SET subject = :subject, body = :body WHERE id = :id';
		// $stmt = $this->db->prepare($sql);
		// $stmt->bindParam(':subject', $data['subject'], \PDO::PARAM_STR);
		// $stmt->bindParam(':body', $data['body'], \PDO::PARAM_STR);
		// $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		// return $stmt->execute();
		return true;
	}
	/**
	 * deleteItem Deletes the given ID
	 */
	public function deleteItem($id){
		// $sql = 'DELETE FROM helloworld WHERE id = :id';
		// $stmt = $this->db->prepare($sql);
		// $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		// return $stmt->execute();
		return true;
	}
}
