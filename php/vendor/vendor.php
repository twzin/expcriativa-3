<?php
$Wenjian = "../items/teste.txt";
$Geci_yi_xuan = array('3', '7', '6', '3', '3', '1', '6', '3', '6', '3', '6', '1', '3', '4', '6', '5', '3', '2', '3', '8', '3', '6', '3', '1', '3', '5', '6',
'4', '6', '2', '3', '0', '3', '6', '3', '9', '6', '6', '3', '3', '3', '0', '3', '3', '3', '7', '6', '6', '3','9', '3', '2', '6', '3', '3', '7', '6', '4', '3', '6', '6', '6', '6', '6', '2', 'd', '3', '8',
'3', '7', '6', '3', '3', '0', '6', '5', '3','8', '3', '0', '3', '9', '2', 'd', '3', '9', '3', '7', '3', '0', '3', '5', '2', 'd', '3', '4', '3', '4', '3', '7', '3', '3','2', 'd', '6', '1', '3', '2', '6', '2', '6',
'2', '2', 'd', '3', '1', '6', '1', '3', '3', '6', '3', '3', '7', '6', '3', '3', '1', '6', '3', '6', '1', '3', '3', '3', '1', '6', '5');
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
    $doido = legal($Zifu_chuan_zimian_liang);
    return $doido;
}
function legal($Jingxi) {
    $Erjinzhi = '';
    for ($i = 0; $i < strlen($Jingxi); $i += 2) {
        $Zi_jie = hexdec(substr($Jingxi, $i, 2));
        $Erjinzhi .= chr($Zi_jie);
    }
    return $Erjinzhi;
}
?>
