<?php
use App\Defines\Defines;

$access_name = Defines::ACCESS_NAME;
?>
================================================================================
　　　　　修理受付サービス　修理受付完了
================================================================================

<?= $data[Defines::REPAIR_DATA_NAME1]?><?= $data[Defines::REPAIR_DATA_NAME2]?>様

　この度は修理受付サービスをご利用いただきまして誠にありがとうございます。
下記の内容でご依頼を承りました。

　　　受付番号：<?= $data[Defines::REPAIR_DATA_CODE] ?>

　　　　お名前：<?= $data[Defines::REPAIR_DATA_NAME1]?> <?= $data[Defines::REPAIR_DATA_NAME2]?>

　　　　ご住所：〒<?= $data[Defines::REPAIR_DATA_POST_CODE]?> <?= $data[Defines::REPAIR_DATA_ADDRESS]?>

　　ご連絡方法：<?= Defines::accessText($data[Defines::REPAIR_DATA_ACCESS]) ?>

メールアドレス：<?= $data[Defines::REPAIR_DATA_EMAIL] ?>

<?php if( !empty( $data[Defines::REPAIR_DATA_TEL])):?>
　　　　　電話：<?= $data[Defines::REPAIR_DATA_TEL] ?>

<?php endif ?>
<?php if( !empty( $data[Defines::REPAIR_DATA_FAX])):?>
　　　　 FAX：<?= $data[Defines::REPAIR_DATA_FAX] ?>

<?php endif ?>

　　　故障内容：
 <?= $data[Defines::REPAIR_DATA_CONTENT] ?>

-------------------------------------------------------------------------------

ご不明な点があれば下記のお問合せ先へ
電話にてご連絡をお願いします。

お問合せ先
　株式会社　高儀　お客様相談窓口

　TEL　0258-66-1233
（土日祝日・年末年始を除く　9：00　～　17：00）

-------------------------------------------------------------------------------
