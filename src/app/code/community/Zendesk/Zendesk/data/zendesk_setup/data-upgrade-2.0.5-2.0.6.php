<?php
/**
 * In this data upgrade we are going to update the web widget settings to use https instead of the current relative format.
 *
select * from core_config_data where path = 'zendesk/frontend_features/web_widget_code_active';

delete from core_config_data where path = 'zendesk/frontend_features/web_widget_code_snippet';
select * from core_config_data where path = 'zendesk/frontend_features/web_widget_code_snippet';
 */

$config = new Mage_Core_Model_Config();

// Retrieve the domain from the config settings
$domain = Mage::getStoreConfig('zendesk/general/domain');

if($domain) {
    // We are activating the Web Widget by default
    $config->saveConfig('zendesk/frontend_features/web_widget_code_active', 1);

    // The Web Widget code snippet, using the account zendesk domain from settings
    $webWidgetSnippet=<<<EOJS
<!-- Start of Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","{$domain}");/*]]>*/</script>
<!-- End of Zendesk Widget script -->
EOJS;

    $config->saveConfig('zendesk/frontend_features/web_widget_code_snippet', $webWidgetSnippet);
}
