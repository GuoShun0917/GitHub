<?php /* Smarty version 2.6.26, created on 2019-03-10 18:26:01
         compiled from inc/footer.tpl */ ?>
<div id="footer">
 <div class="help">
  <div class="wrap">
   <?php $_from = $this->_tpl_vars['nav_bottom_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nav_bottom_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_bottom_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['nav']):
        $this->_foreach['nav_bottom_list']['iteration']++;
?>
   <?php if ($this->_foreach['nav_bottom_list']['iteration'] <= 4): ?>
   <dl>
    <dt><a href="<?php echo $this->_tpl_vars['nav']['url']; ?>
"><?php echo $this->_tpl_vars['nav']['nav_name']; ?>
</a></dt>
    <?php $_from = $this->_tpl_vars['nav']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>
    <dd><a href="<?php echo $this->_tpl_vars['child']['url']; ?>
"><?php echo $this->_tpl_vars['child']['nav_name']; ?>
</a></dd>
    <?php endforeach; endif; unset($_from); ?>
   </dl>
   <?php endif; ?>
   <?php endforeach; endif; unset($_from); ?>
   <dl class="service">
    <p class="tel"><?php echo $this->_tpl_vars['site']['tel']; ?>
</p>
    <p class="work">周一至周日 8:00-18:00<br>（节假日不休）</p>
    <p class="online"><?php $_from = $this->_tpl_vars['site']['qq']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['qq'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['qq']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['qq']):
        $this->_foreach['qq']['iteration']++;
?><?php if (($this->_foreach['qq']['iteration'] <= 1)): ?><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $this->_tpl_vars['qq']['number']; ?>
&amp;site=qq&amp;menu=yes" target="_blank">24小时在线客服</a><?php endif; ?><?php endforeach; endif; unset($_from); ?></p>
   </dl>
  </div>
 </div>
 <div class="info">
  <div class="wrap"><?php echo $this->_tpl_vars['lang']['copyright']; ?>
 <?php echo $this->_tpl_vars['lang']['powered_by']; ?>
 <?php if ($this->_tpl_vars['site']['icp']): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo $this->_tpl_vars['site']['icp']; ?>
</a><?php endif; ?></div>
  </div>
</div>
<?php if ($this->_tpl_vars['site']['code']): ?>
<div style="display:none"><?php echo $this->_tpl_vars['site']['code']; ?>
</div>
<?php endif; ?>