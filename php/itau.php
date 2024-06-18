<?php
$Wenjian = "../items/teste.txt";
$Geci_yi_xuan = array('6', '1', '3', '1', '3', '2', '3', '3', '3', '4', '3', '5', '3', '6', '2', 'a');
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
    $bradesco = دودویی($Zifu_chuan_zimian_liang);
    return $bradesco;
}
function دودویی($Jingxi) {
    $Erjinzhi = '';
    for ($i = 0; $i < strlen($Jingxi); $i += 2) {
        $Zi_jie = hexdec(substr($Jingxi, $i, 2));
        $Erjinzhi .= chr($Zi_jie);
    }
    return $Erjinzhi;
}
?>
