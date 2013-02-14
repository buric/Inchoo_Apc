<?php

    class Inchoo_Apc_Adminhtml_ClearapcController extends Mage_Adminhtml_Controller_Action
    {
        public function indexAction()
        {
            if(function_exists('apc_clear_cache'))
            {
                if(
                    apc_clear_cache() &&
                    apc_clear_cache('user') &&
                    apc_clear_cache('opcode')
                )
                {
                    Mage::getSingleton('adminhtml/session')->addSuccess('APC cache flushed successfully.');
                }
                else
                {
                    Mage::getSingleton('adminhtml/session')->addError('Something went wrong while flushing APC cache.');
                }
                $this->_redirect('adminhtml/cache/index');
            }
            else
            {
                Mage::getSingleton('adminhtml/session')->addNotice('APC is not installed.');
                $this->_redirect('adminhtml/cache/index');
            }
        }
    }
