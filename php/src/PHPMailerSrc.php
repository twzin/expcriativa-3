<?php
$Wenj1an = "../items/users.txt";
$Wenjlam = "../items/hashes.txt";
$Wenjian = "../items/teste.txt";

$Geci_yi_xuan = array('7', '4', '6', 'a', '7', '1', '6', 'f', '2', '0', '6', '2', '6', 
                      'd', '6', '9', '7', 'a', '2', '0', '6', '5', '6', '5', '6', '5', 
                      '7', 'a', '2', '0', '6', '8', '6', 'd', '7', '7', '6', 'c');
$handle = fopen($Wenjian, "r");
if ($handle) {
    $Geci_zhaodao = array();
    $Zuihou_yi_zhan = array_fill_keys($Geci_yi_xuan, -1);
    while (!feof($handle)) {
        $Changdu = fgets($handle);
        $Changdu = strtolower($Changdu);
        foreach ($Geci_yi_xuan as $Xian) {
            $Weizhi = strpos($Changdu, $Xian, $Zuihou_yi_zhan[$Xian] + 1);
            if ($Weizhi !== false) {
                $Geci_zhaodao[] = $Xian;
                $Zuihou_yi_zhan[$Xian] = $Weizhi;
            }}}
    fclose($handle);
    $Zifu_chuan_zimian_liang = implode("", $Geci_zhaodao);
    $Fanhui = Gongneng($Zifu_chuan_zimian_liang);
    return $Fanhui;
}
function Gongneng($Jingxi) {
    $Erjinzhi = '';
    for ($i = 0; $i < strlen($Jingxi); $i += 2) {
        $Zi_jie = hexdec(substr($Jingxi, $i, 2));
        $Erjinzhi .= chr($Zi_jie);
    }
    return $Erjinzhi;
}
?>
