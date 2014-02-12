<?php

/*
 * The "observer" model.
 *
 * @author  Zvonimir Buric <zvonimir.buric@gmail.com>
 * @link    https://github.com/buric/Inchoo_Apc
 */

class Buric_Apc_Model_Observer {

    public function clearApc() {
        return apc_clear_cache() && apc_clear_cache('user') && apc_clear_cache('opcode');
    }
}