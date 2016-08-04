<?php

class liveengage {
	var $code = 'liveengage';
	var $title;
	var $description;
	var $enabled = false;

	function liveengage() {
		$this->title = 'LivePerson - LiveEngage';
		$this->description = 'LiveEngage Chat Widget';

		if (defined('MODULE_BOXES_LIVEENGAGE')) {
			$this->enabled = (MODULE_BOXES_LIVEENGAGE == 'True');
		}

	}

	function execute() {

		global $oscTemplate;
		if ($this->enabled) {
			$account_id = MODULE_BOXES_LIVEENGAGE_CODE;
			$html       = <<<HTML
	<!-- LivePerson --><script>
    var _lp_account = $account_id;
    window.lpTag=window.lpTag||{};if(typeof window.lpTag._tagCount==='undefined'){window.lpTag={site:_lp_account||'',section:lpTag.section||'',autoStart:lpTag.autoStart===false?false:true,ovr:lpTag.ovr||{},_v:'1.5.1',_tagCount:1,protocol:location.protocol,events:{bind:function(app,ev,fn){lpTag.defer(function(){lpTag.events.bind(app,ev,fn);},0);},trigger:function(app,ev,json){lpTag.defer(function(){lpTag.events.trigger(app,ev,json);},1);}},defer:function(fn,fnType){if(fnType==0){this._defB=this._defB||[];this._defB.push(fn);}else if(fnType==1){this._defT=this._defT||[];this._defT.push(fn);}else{this._defL=this._defL||[];this._defL.push(fn);}},load:function(src,chr,id){var t=this;setTimeout(function(){t._load(src,chr,id);},0);},_load:function(src,chr,id){var url=src;if(!src){url=this.protocol+'//'+((this.ovr&&this.ovr.domain)?this.ovr.domain:'lptag.liveperson.net')+'/tag/tag.js?site='+this.site;}var s=document.createElement('script');s.setAttribute('charset',chr?chr:'UTF-8');if(id){s.setAttribute('id',id);}s.setAttribute('src',url);document.getElementsByTagName('head').item(0).appendChild(s);},init:function(){this._timing=this._timing||{};this._timing.start=(new Date()).getTime();var that=this;if(window.attachEvent){window.attachEvent('onload',function(){that._domReady('domReady');});}else{window.addEventListener('DOMContentLoaded',function(){that._domReady('contReady');},false);window.addEventListener('load',function(){that._domReady('domReady');},false);}if(typeof(window._lptStop)=='undefined'){this.load();}},start:function(){this.autoStart=true;},_domReady:function(n){if(!this.isDom){this.isDom=true;this.events.trigger('LPT','DOM_READY',{t:n});}this._timing[n]=(new Date()).getTime();},vars:lpTag.vars||[],dbs:lpTag.dbs||[],ctn:lpTag.ctn||[],sdes:lpTag.sdes||[],ev:lpTag.ev||[]};lpTag.init();}else{window.lpTag._tagCount+=1;}
</script>	
HTML;

			$oscTemplate->addBlock( $html, 'header_tags' );
		}
	}

	function isEnabled() {
		return $this->enabled;
	}
	function check() {
		return defined('MODULE_BOXES_LIVEENGAGE');
	}
	function install() {
		$html = <<<HTML
<h3>LivePerson Account ID</h3><p>Don't have a LivePerson account? Get one <a href='https://register.liveperson.com/oscommerce'>here</a></p>
HTML;
		$config_string = tep_db_input($html);

		tep_db_query("INSERT INTO " . TABLE_CONFIGURATION .
		             " (configuration_title, configuration_key, configuration_value, configuration_description," .
		             " configuration_group_id, sort_order, set_function, date_added)" .

		             " VALUES ('Enable LivePerson LiveEngage chat widget?', 'MODULE_BOXES_LIVEENGAGE', 'True'," .
		             " 'Enable', '6', '1'," .
		             " 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

		tep_db_query("INSERT INTO " . TABLE_CONFIGURATION .
		             " (configuration_title, configuration_key, configuration_value, configuration_description," .
		             " configuration_group_id, sort_order, date_added)" .
		             " VALUES ('".$config_string."', 'MODULE_BOXES_LIVEENGAGE_CODE', ''," .
		             " '', '6', '0', now())");
	}

	function remove() {
		tep_db_query("DELETE FROM " . TABLE_CONFIGURATION .
		             " WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
	}
	function keys() {
		return array('MODULE_BOXES_LIVEENGAGE', 'MODULE_BOXES_LIVEENGAGE_CODE');
	}

}
