<?php /* Smarty version 2.6.26, created on 2019-03-10 18:26:01
         compiled from inc/recommend_product.tpl */ ?>
<?php if ($this->_tpl_vars['recommend_product']): ?>
<div id="recProduct">
 <div class="wrap">
  <h3><a href="<?php echo $this->_tpl_vars['url']['product']; ?>
"><?php echo $this->_tpl_vars['lang']['product_news']; ?>
</a></h3>
  <ul class="productList">
   <?php $_from = $this->_tpl_vars['recommend_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_product'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_product']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['recommend_product']['iteration']++;
?>
   <li<?php if ($this->_foreach['recommend_product']['iteration'] % 4 == 0): ?> class="clearBorder"<?php endif; ?>>
    <p class="img"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['product']['thumb']; ?>
" width="220" height="220" /></a></p>
    <p class="name"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
" title="<?php echo $this->_tpl_vars['product']['name']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a></p>
    <p class="brief"><?php echo $this->_tpl_vars['product']['description']; ?>
</p>
    <p class="btnList">
     <span class="price"><?php echo $this->_tpl_vars['product']['price']; ?>
</span>
     <span class="cart"><a href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
order.php?rec=insert&product_id=<?php echo $this->_tpl_vars['product']['id']; ?>
" target="_blank"><?php echo $this->_tpl_vars['lang']['order_addtocart']; ?>
</a></span>
    </p>
   </li>
   <?php endforeach; endif; unset($_from); ?>
  </ul>
 </div>
</div>
<?php endif; ?>