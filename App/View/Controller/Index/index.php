<?php  use \App\Base\Helper\Html;?>
<?php  require "form_search.php"; ?>
<br>
<?php  require "paginator.php"; ?>
<br>
<?php  require "sort.php"; ?>

<?php
if (is_array($newsList)) {?>
<table class="table" border="1px" width="100%">
    <?php foreach ($newsList as $message) { ?>
        <tr>
            <td>
                <b>name:</b><?=Html::escape($message['name']);?>
                <br>
                <b>author:</b><?=Html::escape($message['author']);?>
                <br>
                <b>tags:</b>
                <?=Html::escape($message['tags']);?>
                <br>
                <b>text:</b>
                <?=Html::escape(mb_substr($message['text'], 0, 200));?>
                <a href="/news/<?=$message['id'];?>"> More </a>
                <br>
                <b>date:</b>
                <?=date('Y-m-d H:i:s', $message['created_at']);?>

            </td>

        </tr>
    <?php } ?>

</table>
<?php } else { ?>
    Empty news list
<?php } ?>

<?php require "form.php";?>