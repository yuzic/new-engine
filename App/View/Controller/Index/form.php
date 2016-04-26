<?php
    use \Aqua\Base\Request;
    use \App\Base\Helper\Html;
    use \App\Base\Helper\Protection;
?>

<h3> Send news </h3>

<?php if (!empty($notify['message'])) { ?>
    <div style="color: green"><?=$notify['message'];?> </div>
<?php } ?>
<form method="post" id="contact-form" style="margin-left: 10px">
    <input type="hidden" name="news" value="1">

    <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
            <input name="name" type="text" id="author" placeholder="News name" required value="<?=Html::escape(Request::post('name'));?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="text">Author</label>
        <div class="controls">
            <input name="author" type="text" id="author" placeholder="Author name" required value="<?=Html::escape(Request::post('author'));?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="tags">Tags</label>
        <div class="controls">
            <input name="tags" type="text" id="tags" placeholder="Your Tags" required value="<?=Html::escape(Request::post('tags'));?>">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="text">Text</label>
        <div class="controls">
            <textarea name="text" required cols="40" id="text" placeholder="You Text" rows="10"><?=Html::escape(Request::post('text'));?></textarea>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-success">Submit Message</button>
        <button type="reset" class="btn">Cancel</button>
    </div>

    <?php if (!empty($notify['error'])) { ?>
        <div style="color: red"><?=$notify['error'];?> </div>
    <?php } ?>
</form>

<script>
    $(document).ready(function () {

        $('#contact-form').validate({
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    minlength: 2,
                    required: true
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid')
                    .closest('.control-group').removeClass('error').addClass('success');
            }
        });

    });
</script>