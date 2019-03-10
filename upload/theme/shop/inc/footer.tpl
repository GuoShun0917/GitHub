<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="footer">
 <div class="help">
  <div class="wrap">
   <!-- {foreach from=$nav_bottom_list name=nav_bottom_list item=nav} -->
   <!-- {if $smarty.foreach.nav_bottom_list.iteration le 4} -->
   <dl>
    <dt><a href="{$nav.url}">{$nav.nav_name}</a></dt>
    <!-- {foreach from=$nav.child item=child} -->
    <dd><a href="{$child.url}">{$child.nav_name}</a></dd>
    <!-- {/foreach} -->
   </dl>
   <!-- {/if} -->
   <!-- {/foreach} -->
   <dl class="service">
    <p class="tel">{$site.tel}</p>
    <p class="work">周一至周日 8:00-18:00<br>（节假日不休）</p>
    <p class="online"><!-- {foreach from=$site.qq name=qq item=qq} --><!-- {if $smarty.foreach.qq.first} --><a href="http://wpa.qq.com/msgrd?v=3&amp;uin={$qq.number}&amp;site=qq&amp;menu=yes" target="_blank">24小时在线客服</a><!-- {/if} --><!-- {/foreach} --></p>
   </dl>
  </div>
 </div>
 <div class="info">
  <div class="wrap">{$lang.copyright} {$lang.powered_by} <!-- {if $site.icp} --><a href="http://www.miibeian.gov.cn/" target="_blank">{$site.icp}</a><!-- {/if} --></div>
  </div>
</div>
<!-- {if $site.code} -->
<div style="display:none">{$site.code}</div>
<!-- {/if} -->