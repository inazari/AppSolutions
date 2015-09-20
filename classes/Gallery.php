<?php

class Gallery
{

    private $_data;

    public function __construct($id = null)
    {
        $this->_db = DB::getInstance();

        if (isset($id)) {
            $this->find($id);
        }
    }


    public function create($fields = null)
    {

        if (!$this->_db->insert('galleries', $fields)) {
            throw new Exception('<div class="message">There was a problem upload foto</div>');
        }
    }

    public function find($id)
    {
        if ($id) {
            $data = $this->_db->get('galleries', array('user_id', '=', $id));

            if ($data->count()) {
                $this->_data = $data->results();
                return true;
            }
        }
        return false;
    }

    public function images()
    {
        return $this->data();
    }

    public function data()
    {
        return $this->_data;
    }

    public function exists($reference)
    {
        if ($this->_db->get('galleries', array('image', '=', $reference))->count() > 0) {
            return true;
        }
        return false;
    }


}


?>