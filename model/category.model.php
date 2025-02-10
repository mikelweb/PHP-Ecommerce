<?php
class Category {
	public $db;
	public $id;
    public $name;
	public $description;
	public $img;

    public function __construct($db, $id = null, $name = null, $description = null, $img = null) {
        $this->db = $db;
		$this->id=$id;
		$this->name = $name;
		$this->description = $description;
		$this->img = $img;
    }
	
	public function getCategory($catId) {
		$cat = $this->db->query('SELECT * FROM Category WHERE id = ?', $catId)->fetchArray();
		return new Category(null, $cat['id'], $cat['name'], $cat['description'], $cat['img']);
	}
	
	public function getCategories() {
		$categoryObjsArray = [];
		$categories = $this->db->query('SELECT * FROM Category')->fetchAll();
		foreach($categories as $cat) {
			$categoryObj = new Category(null, $cat['id'], $cat['name'], $cat['description'], $cat['img']);
			array_push($categoryObjsArray, $categoryObj);
		}
		return $categoryObjsArray;
	}

}

?>