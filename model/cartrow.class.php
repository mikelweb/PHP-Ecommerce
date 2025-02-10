<?php
class CartRow {
    public $item;
    public $amount;

    public function __construct($item, $amount) {
		$this->item = $item;
		$this->amount = $amount;
    }

	/*public function updateAmount() {
		return $this->item;
    }

	
	public function deleteItems() {
		return $this->item;
    }*/
	
    public function getRowTotal() {
        return $this->item->price * $this->amount;
    }
}

?>