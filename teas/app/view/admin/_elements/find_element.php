<?php $_hidden_elements = array(); ?>


<form <?php foreach ($findform->attrs() as $attr => $value): $value = h($value); echo "{$attr}=\"{$value}\" "; endforeach; ?>>
<?php
foreach ($findform->elements() as $element):
    if ($element->_ui == 'hidden')
    {
        $_hidden_elements[] = $element;
        continue;
    }
    $id =$element->id;
?>
 	<?php if ($element->_label): ?>
    <label for="<?php echo $id; ?>"><?php echo h($element->_label); ?></label><?php endif; ?>
	<?php echo Q::control($element->_ui, $id, $element->attrs()); ?>
   


<?php endforeach;?>
  <input type="submit" value="查询">
<?php foreach ($_hidden_elements as $element): ?>
      <input type="hidden" name="<?php echo $element->id; ?>" id="<?php echo $element->id; ?>" value="<?php echo h($element->value); ?>" />

      <?php endforeach; ?>
 </form>
 