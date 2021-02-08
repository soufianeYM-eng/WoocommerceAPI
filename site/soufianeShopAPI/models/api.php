<?php
$GOLBALS = array(
    'CK' => '',
    'CS' => ''
);
session_start();

class WoocommerceAPI
{
    public $keys;

    public function initialize()
    {
        global $GLOBALS;
        $this->keys = &$GLOBALS;
    }

    public function setCK($ck)
    {
        $GLOBALS['CK'] = $ck;
    }

    public function setCS($cs)
    {
        $this->keys['CS'] = $cs;
    }

    public function getCK()
    {
        return $this->keys['CK'];
    }

    public function getCS()
    {
        return $this->keys['CS'];
    }
}
