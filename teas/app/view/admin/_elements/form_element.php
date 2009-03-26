<?php $_hidden_elements = array(); ?>

<form <?php foreach ($form->attrs() as $attr => $value): $value = h($value); echo "{$attr}=\"{$value}\" "; endforeach; ?>>

  <fieldset>
    <?php if ($form->_tips): ?>
    <legend><?php echo h($form->_subject); ?></legend>
    <?php endif; ?>

<?php
foreach ($form->elements() as $element):
    if ($element->_ui == 'hidden')
    {
        $_hidden_elements[] = $element;
        continue;
    }
    $id = $element->id;
?>

  <p id="<?php echo $element->id; ?>_wrap" <?php if ($element->_hidden): ?>class="hidden"<?php endif; ?>>
    <?php if ($element->_label): ?>
    <label for="<?php echo $id; ?>"><?php echo h($element->_label); ?>:</label><?php endif; ?>
<?php echo Q::control($element->_ui, $id, $element->attrs()); ?>
<?php if ($element->_req): ?><span class="req">*</span><?php endif; ?>
   <?php if ($element->_tips): ?><span class="tips"><?php echo nl2br(str_replace(array('[b]', '[/b]'), array('<strong>', '</strong>'), h($element->_tips))); ?></span><?php endif; ?>
 <?php if (!$element->isValid()): ?>
    <span class="error"><?php echo nl2br(h(implode("，", $element->errorMsg()))); ?></span>
    <?php endif; ?>
  </p>

<?php
endforeach;
?>

    <p>
      <input type="submit" name="btn_submit" value="提交" class="btn" />

      <?php if ($form->_reset): ?>
      <input type="reset" name="btn_reset" value="重置" class="btn" />
      <?php endif; ?>

      <?php if ($form->_cancel_url): ?>
      <input type="button" name="btn_cancel" value="取消" onclick="document.location.href='<?php echo h($form->_cancel_url); ?>'; return false;" class="btn" />
      <?php endif; ?>

      <?php foreach ($_hidden_elements as $element): ?>
      <input type="hidden" name="<?php echo $element->id; ?>" id="<?php echo $element->id; ?>" value="<?php echo h($element->value); ?>" />

      <?php endforeach; ?>
    </p>

  </fieldset>

</form>
