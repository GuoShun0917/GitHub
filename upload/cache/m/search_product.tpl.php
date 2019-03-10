<?php /* Smarty version 2.6.26, created on 2019-03-10 19:07:07
         compiled from inc/search_product.tpl */ ?>
<div class="searchBox">
 <form name="search" method="get" action="<?php echo $this->_tpl_vars['site']['m_url']; ?>
">
  <input name="s" type="text" class="keyword" autocomplete="off" maxlength="128" value="<?php if ($this->_tpl_vars['keyword']): ?><?php echo $this->smarty_modifier_escape($this->_tpl_vars['keyword']); ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['search_product']; ?>
<?php endif; ?>" onclick="formClick(this,'<?php echo $this->_tpl_vars['lang']['search_product']; ?>
')">
  <input type="submit" class="btnSearch" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
">
 </form>
</div>