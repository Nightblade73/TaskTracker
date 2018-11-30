<?php

class Role_Model extends Model {

    public function get_data() {
        return R::find('roles');
    }

}
