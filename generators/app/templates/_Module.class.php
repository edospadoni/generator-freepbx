<?php
namespace FreePBX\modules;
/*
 * Class stub for BMO Module class
 * In _Construct you may remove the database line if you don't use it
 * In getActionbar change "modulename" to the display value for the page
 * In getActionbar change extdisplay to align with whatever variable you use to decide if the page is in edit mode.
 *
 */

 $setting = array('authenticate' => true, 'allowremote' => false);

class <%= name.charAt(0).toUpperCase() + name.slice(1) %> implements \BMO
{
    public function __construct($freepbx = null)
    {
        if ($freepbx == null) {
            throw new Exception("Not given a FreePBX Object");
        }
        $this->FreePBX = $freepbx;
        $this->db = $freepbx->Database;
    }
    public function install()
    {
    }
    public function uninstall()
    {
    }
    public function backup()
    {
    }
    public function restore($backup)
    {
    }
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
    public function getRightNav($request)
    {
        $html = '<p>Custom HTML</p>';
        return $html;
    }
    public function showPage(){
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