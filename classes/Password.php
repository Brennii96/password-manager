<?php

class Password
{
    private $_db,
        $_list;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    private function generate($length = 15)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*(){}/?,><";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function create($fields)
    {
        if (!$this->_db->insert('password_management', $fields)) {
            throw new Exception('There was a problem.');
        }
    }

    public function update($fields = array(), $id = null)
    {
        $user = new User();
        if (!$id && $user->isLoggedIn()) {
            $id = $this->list()->id;
        }

        if (!$this->_db->update('password_management', $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function favicon($url)
    {
        $elems = parse_url($url);
        $url = $elems['scheme'] . '://' . $elems['host'];

        # load site
        $output = file_get_contents($url);

        # look for the shortcut icon inside the loaded page
        $regex_pattern = "/rel=\"shortcut icon\" (?:href=[\'\"]([^\'\"]+)[\'\"])?/";
        preg_match_all($regex_pattern, $output, $matches);

        if (isset($matches[1][0])) {
            $favicon = $matches[1][0];

            # check if absolute url or relative path
            $favicon_elems = parse_url($favicon);

            # if relative
            if (!isset($favicon_elems['host'])) {
                $favicon = $url . '/' . $favicon;
            }

            return $favicon;
        }

        return false;
    }

    public function find($entry = null)
    {
        if ($entry) {
            $field = (is_numeric($entry)) ? 'id' : 'username';
            $data = $this->_db->get('password_management', array($field, '=', $entry));

            if ($data->count()) {
                $this->_list = $data->first();
                return $this->_list;
            }
        }
        return false;
    }

    public function delete($id)
    {
        $this->_db->delete('password_management', array('id', '=', $id));
    }

    public function show($key)
    {
        $list = $this->_db->get('password_management', array('user_id', '=', $key));

        return $list->results();
    }

    public function list()
    {
        return $this->_list;
    }
}