<?php

use App\Defines\Defines;
?>
================================================================================
　　　　　問合せ受付サービス　お問合せ受付完了
================================================================================

<?= $data[Defines::INQUIRY_DATA_NAME1] ?><?= $data[Defines::INQUIRY_DATA_NAME2] ?>様

　この度は問合せ受付サービスをご利用いただきまして誠にありがとうございます。
下記の内容で問合せを承りました。

受付番号　　<?= $data[Defines::INQUIRY_DATA_CODE] ?>

お名前： <?= $data[Defines::INQUIRY_DATA_NAME1] ?> <?= $data[Defines::INQUIRY_DATA_NAME2] ?>

ご住所：〒<?= $data[Defines::INQUIRY_DATA_POST_CODE] ?> <?= $data[Defines::INQUIRY_DATA_ADDRESS] ?>

ご連絡方法： <?= Defines::accessText($data[Defines::INQUIRY_DATA_ACCESS]) ?>

メールアドレス：<?= $data[Defines::INQUIRY_DATA_EMAIL] ?>

<?php if( !empty( $data[Defines::INQUIRY_DATA_TEL])):?>
電話：<?= $data[Defines::INQUIRY_DATA_TEL] ?>

<?php endif ?>
<?php if( !empty( $data[Defines::INQUIRY_DATA_FAX])):?>
FAX：<?= $data[Defines::INQUIRY_DATA_FAX] ?>

<?php endif ?>

お問合せ内容：
<?= $data[Defines::INQUIRY_DATA_CONTENT] ?>

-------------------------------------------------------------------------------

ご不明な点があれば下記のお問合せ先へ
電話にてご連絡をお願いします。

お問合せ先
TEL:0000-00-0000
（年末年始・土日祝日を除く平日　午前9時～午後5時）

===============================================================================
高儀
===============================================================================
