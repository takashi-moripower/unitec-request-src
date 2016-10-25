<?php
use App\Defines\Defines;

$access_name = Defines::ACCESS_NAME;
?>
================================================================================
　　　　　修理受付サービス　修理受付完了
================================================================================

<?= $data[Defines::REPAIR_DATA_NAME1]?><?= $data[Defines::INQUIRY_DATA_NAME2]?>様

　この度は修理受付サービスをご利用いただきまして誠にありがとうございます。
下記の内容で修理受付を承りました。

受付番号　　<?= $data[Defines::INQUIRY_DATA_CODE] ?>

お名前： <?= $data[Defines::INQUIRY_DATA_NAME1]?> <?= $data[Defines::INQUIRY_DATA_NAME2]?>

ご住所：〒<?= $data[Defines::INQUIRY_DATA_POST_CODE]?> <?= $data[Defines::INQUIRY_DATA_ADDRESS]?>

ご連絡方法： <?= $access_name[ $data[Defines::INQUIRY_DATA_ACCESS ]]?>

メールアドレス：<?= $data[Defines::INQUIRY_DATA_EMAIL] ?>

お問合せ内容：
 <?= $data[Defines::INQUIRY_DATA_CONTENT] ?>

-------------------------------------------------------------------------------

ご不明な点があれば下記のお問合せ先へ
電話にてご連絡をお願いします。

お問合せ先
TEL:0000-00-0000
（日祝および年末年始、夏季休暇中を除く　午前9時～午後5時）

===============================================================================
高儀
===============================================================================
