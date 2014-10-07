                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                // Gridset Toggle JS

gs = {

	init: function (p, c, w) {
	
		gs.bind(document, 'keydown', function (e) { 
		
			if (!e) var e = window.event;
		
			if(e.metaKey || e.ctrlKey) {
				
				switch (e.which || e.keyCode) {
					case 71:
					
						var gw = document.getElementById('gridsetoverlaywrap');
					
						if (!gw) gs.show(['d','t','m'], [12,4,1], [1024,768,320]);
						else document.body.removeChild(gw);
						
						gs.prevent(e);
						break;
				}
				
			}
		
		
		});
	
	},

	show: function (p, c, w) {
	
		var b = CSCO_WebVPN["call"](document,"getElementsByTagName")('body')[0],
			gw = '<div id="gridwrap"><div id="gridoverlay" class="wrapper">',
		
			k = 0, breaks = '',
			
			styles = '<style id="gridsetoverlaystyles" type="text/css">#gridsetoverlaywrap{position:static;}#gridwrap {display:block;position:fixed;top:0;left:0;width:100%;height:100%;z-index:1000;pointer-events:none;font-family:Helvetica, Arial, sans-serif !important;}#gridoverlay{position:relative;height:100%;overflow:hidden !important;background:none !important;}#gridoverlay div{display:block;position:static;height:100%;color:rgb(150,150,255);}#gridoverlay .gridset{position:absolute;width:100%;height:100%;top:0;left:0;opacity:0.3;}#gridoverlay .gridset div{padding-top:5px;text-align:left;font-size:10px !important;border-right:1px solid rgb(150,150,255);border-left:1px solid rgb(150,150,255);-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;}#gridoverlay div small{width:100%;display:block;text-align:center;color:rgb(130,130,255);font-weight:700 !important;border-bottom:1px solid rgb(150,150,255);padding-top:0 !important;}#gridoverlay .gridset:nth-child(2) div{border-style:dashed;padding-top:35px;}#gridoverlay .gridset:nth-child(2) small{border-bottom:1px dashed rgb(150,150,255);}#gridoverlay .gridset:nth-child(3) div{border-style:dotted;padding-top:70px;}#gridoverlay .gridset:nth-child(3) small{border-bottom:1px dotted rgb(150,150,255);}.noshow{display:none;}</style>';
						
		while (p[k]) {
		
			var hides = '', 
				l = 0;
		
			if (w[k] != breaks && k == 0) gw += '<div>';
			else if (w[k] != breaks) gw += '</div><div>';
		
			while (p[l]) {
		
				if (l != k && w[l] != w[k]) hides += p[l] + '-hide ';
				l++;			
		
			}
		
			gw += '<div class="gridset ' + hides + '"><div class="'+p[k]+'1"><small>'+p[k]+'1</small></div>';
		
			var i = 1;
		
			while (i++ < c[k]) gw += '<div class="'+p[k]+i+'"><small>'+p[k]+i+'</small></div>';
		
			gw += '</div>';
		
			if (k == w.length - 1) gw += '</div>';
		
			breaks = w[k];
		
			k++;
		
		}
		
		gw += '</div></div>';
		
		var newgw = CSCO_WebVPN["call"](document,"createElement")('div');
		
		newgw.id = 'gridsetoverlaywrap';
		
		CSCO_Util["nope"]((csco_tmp_3995=newgw,csco_tmp_3995.innerHTML=CSCO_WebVPN["put"](csco_tmp_3995,"innerHTML",gw + styles)));
		
		CSCO_WebVPN["call"](b,"appendChild")(newgw);
	
	},
	
	bind : function (t, e, f) {
		
		if (t.attachEvent) t.attachEvent('on' + e, f);
		else t.addEventListener(e, f, false);
	
	},
	
	prevent : function (e) {
	
		if (e.preventDefault) e.preventDefault();
		else event.returnValue = false;
	
	}


};

if (CSCO_WebVPN["get"](CSCO_WebVPN["get"](window,"location"),"href").match('gridset=show')) gs.show(['d','t','m'], [12,4,1], [1024,768,320]);
else gs.init(['d','t','m'], [12,4,1], [1024,768,320]);
CSCO_WebVPN["flush"]();