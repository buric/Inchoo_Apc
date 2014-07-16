<?php

/*
 * The "observer" model.
 *
 * @author  Zvonimir Buric <zvonimir.buric@gmail.com>
 * @link    https://github.com/buric/Inchoo_Apc
 */

class Buric_Apc_Model_Observer {

    public function clearApc() {
        return function_exists('apc_clear_cache') && apc_clear_cache() && apc_clear_cache('user') && apc_clear_cache('opcode');
    }

    public function injectHtml(Varien_Event_Observer $observer) {
        $block  = $observer->getBlock();

        if($block instanceof Mage_Adminhtml_Block_Cache_Additional) {
            $transport = $observer->getTransport();

            $insert =
                '<tr>
                    <td class="scope-label">
                        <button onclick="setLocation(\'' . Mage::helper('adminhtml')->getUrl('adminhtml/clearapc/index') . '\')" type="button" class="scalable">
                            <span>' . Mage::helper('adminhtml')->__('Flush APC Cache') . '</span>
                        </button>
                    </td>
                    <td class="scope-label">' . Mage::helper('adminhtml')->__('APC user and system cache.') . '</td>
                </tr>';

            $dom = new DOMDocument();

            $dom->loadHTML($transport->getHtml());

            $td = $dom->createDocumentFragment();
            $td->appendXML($insert);

            $dom->getElementsByTagName('table')->item(1)->insertBefore($td, $dom->getElementsByTagName('table')->item(1)->firstChild);

            $transport->setHtml($dom->saveHTML());
        }
    }
}
