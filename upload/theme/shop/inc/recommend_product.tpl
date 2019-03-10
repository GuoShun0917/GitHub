<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- {if $recommend_product} -->
<div id="recProduct">
 <div class="wrap">
  <h3><a href="{$url.product}">{$lang.product_news}</a></h3>
  <ul class="productList">
   <!-- {foreach from=$recommend_product name=recommend_product item=product} -->
   <li<!-- {if $smarty.foreach.recommend_product.iteration % 4 eq 0} --> class="clearBorder"<!-- {/if} -->>
    <p class="img"><a href="{$product.url}"><img src="{$product.thumb}" width="220" height="220" /></a></p>
    <p class="name"><a href="{$product.url}" title="{$product.name}">{$product.name}</a></p>
    <p class="brief">{$product.description}</p>
    <p class="btnList">
     <span class="price">{$product.price}</span>
     <span class="cart"><a href="{$site.root_url}order.php?rec=insert&product_id={$product.id}" target="_blank">{$lang.order_addtocart}</a></span>
    </p>
   </li>
   <!-- {/foreach} -->
  </ul>
 </div>
</div>
<!-- {/if} -->