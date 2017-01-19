<?php
use App\Defines\Defines;
?>
================================================================================
　　　　　部品購入受付サービス　部品購入受付完了
================================================================================

<?= $data[Defines::SELL_DATA_NAME1] ?><?= $data[Defines::SELL_DATA_NAME2] ?>様

　この度は部品購入受付サービスをご利用いただきまして誠にありがとうございます。
下記の内容でご注文を承りました。

受付番号　　<?= $data[Defines::SELL_DATA_CODE] ?>

お名前： <?= $data[Defines::SELL_DATA_NAME1] ?> <?= $data[Defines::SELL_DATA_NAME2] ?>

ご住所：〒<?= $data[Defines::SELL_DATA_POST_CODE] ?> <?= $data[Defines::SELL_DATA_ADDRESS] ?>

ご連絡方法： <?= Defines::accessText($data[Defines::SELL_DATA_ACCESS]) ?>

メールアドレス：<?= $data[Defines::SELL_DATA_EMAIL] ?>

<?php if( !empty( $data[Defines::SELL_DATA_TEL])):?>
電話：<?= $data[Defines::SELL_DATA_TEL] ?>

<?php endif ?>
<?php if( !empty( $data[Defines::SELL_DATA_FAX])):?>
FAX：<?= $data[Defines::SELL_DATA_FAX] ?>

<?php endif ?>

連絡メモ：
<?= $data[Defines::SELL_DATA_CONTENT] ?>

-------------------------------------------------------------------------------

購入内容
<?php
$sum_all = 0;
foreach ($parts as $p):
	$sum = $p['cost'] * $p['count'];
	$sum_all += $sum;
?>
<?= $p['id'] ?>  <?= $p['name'] ?> ￥<?= number_format($p['cost']) ?> × <?= $p['count'] ?>　=　<?= number_format($sum) ?>

<?php endforeach ?>


小計　￥<?= number_format($sum_all) ?>

消費税￥<?= number_format($sum_all * 0.08) ?>

合計　￥<?= number_format($sum_all * 1.08) ?>

(送料については別途ご連絡いたします)

ご不明な点があれば下記のお問合せ先へ
電話にてご連絡をお願いします。

お問合せ先
TEL:0000-00-0000
（年末年始・土日祝日を除く平日　午前9時～午後5時）

===============================================================================
高儀
===============================================================================
