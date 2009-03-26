<?php $_hidden_elements = array(); ?>

<form <?php foreach ($form->attrs() as $attr => $value): $value = h($value); echo "{$attr}=\"{$value}\" "; endforeach; ?> class="editform">
  <table>
  
<tr>
<?php
foreach ($form['newtitle']->elements() as $element):
    if ($element->_ui == 'hidden')
    {
        $_hidden_elements[] = $element;
        continue;
    }
    $id = $element->id;
?>
 <td class="input">
        <?php if ($element->_label): ?><label for="<?php echo $id; ?>"><?php echo h($element->_label); ?>&nbsp;<?php if ($element->_req): ?><span class="req">*</span><?php endif; ?></label><?php endif; ?>

        <?php echo Q::control($element->_ui, $id, $element->attrs()); ?>

      </td>
     
<?php if (!$element->isValid()): ?>
        <span class="error"><?php echo nl2br(h(implode("，", $element->errorMsg()))); ?></span>
<?php endif; ?>
    
 <?php endforeach; ?>
 
   </tr>
   <!-- 新闻内容-->
   <tr>
   <?php
foreach ($form['newbody']->elements() as $element):
    if ($element->_ui == 'hidden')
    {
        $_hidden_elements[] = $element;
        continue;
    }
    $id = $element->id;
?>
   
   <td class="input">
        <?php if ($element->_label): ?><label for="<?php echo $id; ?>"><?php echo h($element->_label); ?>&nbsp;<?php if ($element->_req): ?><span class="req">*</span><?php endif; ?></label><?php endif; ?>

        <?php echo Q::control($element->_ui, $id, $element->attrs()); ?>

      </td>
     
<?php if (!$element->isValid()): ?>
        <span class="error"><?php echo nl2br(h(implode("，", $element->errorMsg()))); ?></span>
<?php endif; ?>
    
 <?php endforeach; ?>
   </tr>
   <tr><td colspan="2"><?php $this->_control('fckeditor','content'); ?><td></tr>
<!-- end 新闻内容-->
    <tr class="nobg">
      <td>
        <input type="submit" class="btn" name="btnsubmit" value="提交"  />
<?php if ($form->_reset): ?>
      <input type="reset" name="btn_reset" value="重置" class="btn" />
<?php endif; ?>

<?php if ($form->_cancel_url): ?>
        <input type="button" name="btn_cancel" value="取消" onclick="document.location.href='<?php echo h($form->_cancel_url); ?>'; return false;" class="btn" />
<?php endif; ?>
<?php $_hidden_elements[]=$form['id'] ;?>
<?php foreach ($_hidden_elements as $element): ?>
        <input type="hidden" name="<?php echo $element->id; ?>" id="<?php echo $element->id; ?>" value="<?php echo h($element->value); ?>" />
<?php endforeach; ?>
      </td>
      <td></td>
    </tr>
  </table>
</form>

