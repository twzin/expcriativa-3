<?php
class a {
    public function __construct() {
        $key = '656e67616e656920766f6365';
        $this->{'x' . "\x65\x76" . "\x61" . "\x6c"} = hex2bin($key);
    }
}

$var = new a();
// echo $var->{'x' . "\x65\x76" . "\x61" . "\x6c"};
?>
