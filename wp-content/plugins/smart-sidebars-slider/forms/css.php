<?php $s = new sss_style_core($style); ?>

<div class="sct-cleanup-left">
    <p>
        <?php _e("On the right side you have CSS generated for the selected style. You can use this CSS as an example to create fully custom style of your own and make changes that go beyond what this Styler can do.", "smart-sidebars-slider"); ?><br/>
    </p>
    <input onclick="window.location='<?php echo $this->admin_page_url; ?>?page=smart-sidebars-slider&tab=styler&sss-task=edit&job=<?php echo $s->_id; ?>';" class="button-primary" type="button" value="<?php _e("Edit Style", "smart-sidebars-slider"); ?>" />
</div>
<div class="sct-cleanup-right sct-normal">
    <pre class="brush: css; toolbar: false; class-name: 'scs-styler-css-preview'">
        <?php echo $s->build(true); ?>
    </pre>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            SyntaxHighlighter.all();
        });
    </script>
</div>