var _nch = 'b20b1e0ccd9e96dd8cb7b06532aaa5c27a4d2fb2';

gcApp.implement({changeRibbonTab:function(b){if(b.tab==0){this.loadHomeWorkspace()}else{this.loadMapWorkspace()}var a=b.element?b.element.get("id"):null;if(a){giscloud.log.push("ribbon_tab_change",{tabid:a})}},initUI:function(){if(fno.mobilebrowser){var a=new Element("style",{type:"text/css",html:".mif-tree-node { padding: 0.8em !important; }"});a.inject(document.getElementsByTagName("head")[0])}if(this.options.mochaui){this.leftcolumn=new MUI.Column({id:"leftColumn",placement:"left",width:300,sortable:false,resizeLimit:[200,300],onResize:function(){gcapp.onResize()},onCollapse:function(){gcapp.onResize()},onExpand:function(){gcapp.onResize()}});if(fno.mobilebrowser){this.leftcolumn.collapse()}this.maincolumn=new MUI.Column({id:"mainColumn",placement:"main",sortable:false,onResize:(function(){gcapp.onResize();this.dataPanelResizeF.call(this)}).bind(this)});this.rightcolumn=new MUI.Column({id:"rightColumn",placement:"right",sortable:false,width:260,resizeLimit:[260,400],onResize:function(){if(gcapp.rpanel){gcapp.rpanel.fireEvent("resize")}gcapp.onResize()},onCollapse:function(){if(gcapp.rpanel){gcapp.rpanel.fireEvent("resize")}gcapp.onResize();var b=$("rightColumn_handle_icon").getElement(".handleArrow");b&&b.setStyle("background-position","-48px 0")},onExpand:function(){if(gcapp.rpanel){gcapp.rpanel.fireEvent("resize")}gcapp.onResize();var b=$("rightColumn_handle_icon").getElement(".handleArrow");b&&b.setStyle("background-position","0 0")}});this.rightcolumn.collapse()}this.initCentralPanel();this.initLeftPanel();this.initRightPanel()},initLeftPanel:function(a){if($("layers-panel")||this.options.mochaui){this.layerPanel=this.loadPanel({id:"layers-panel",title:gclang.layers,contentURL:fno.liveSite+"layer/module?fullaccess="+fno.fullaccess+"&lang="+user.language+"&nch="+_nch,column:"leftColumn",collapsible:false,sortable:false,footer:true,footerRenderer:function(c){c.footer.set("html","<div id='alphaSlider' class='slider'><div class='knob'></div></div>")},onContentLoaded:function(){gcapp.gclayer=new gcLayerModul()},onResize:function(){if(gcapp.gclayer){gcapp.gclayer.onResize()}}})}if(fno.mobilebrowser){if($("leftColumn_handle_icon")){var b=function(c){gcapp.leftcolumn.columnToggle();if(gcapp.leftcolumn.isCollapsed){$("leftColumn_handle_icon").getElement(".handleArrow").setStyle("background-position","0 0")}else{$("leftColumn_handle_icon").getElement(".handleArrow").setStyle("background-position","-48px 0")}c.stopPropagation()};$("leftColumn_handle_icon").grab(new Element("div",{"class":"handleIconBg"})).grab(new Element("div",{"class":"handleArrow",style:"background-position: 0 0"})).addClass("handleIcon").addEvent("touchend",b).addEvent("click",b);$("leftColumn_handle").addEvent("touchend",b).setStyle("overflow","visible")}}else{jQuery(".gc-drag-n-drop-strip-left").click(function(){if(gcapp.leftcolumn.isCollapsed){if(gcapp.leftcolumn){gcapp.leftcolumn.columnToggle()}}})}},initRightPanel:function(a){if(this.options.mochaui){this.rightPanelResizeF=function(){if(gcapp.rpanel){gcapp.rpanel.fireEvent("resize")}};var d=this.loadPanel({id:"rightpanel",contentURL:fno.liveSite+"modules_gc/search/rightpanel.php?lang="+user.language+"&nch="+_nch,column:"rightColumn",scrollbars:false,onContentLoaded:function(){gcapp.rpanel=new gcRightPanel();gcapp.selo=new gcSelection({parentColumn:gcapp.rightcolumn});gcapp.gcsearch=new gcSearch()},onResize:this.rightPanelResizeF})}else{gcapp.selo=new gcSelection({parentColumn:gcapp.rightcolumn});gcapp.gcsearch=new gcSearch()}if(this.options.mochaui){var c="<div class='toolbarTabs' >";c+="<ul id='rightPanelTabs' class='tab-menu' >";c+="	<li id='panelTabs1Link' class='selected' ><a>Info</a></li>";c+="	<li id='panelTabs2Link' ><a>"+gclang.Search_action+"</a></li>";c+="</ul>";c+="<div class='clear'></div>";c+="</div>";d.panelHeaderContentEl.addClass("tabs");d.panelHeaderContentEl.set("html",c);MochaUI.initializeTabs("rightPanelTabs")}if(fno.mobilebrowser&&this.options.mochaui){var b=function(e){gcapp.rightcolumn.columnToggle();e.stopPropagation()};$("rightColumn_handle_icon").setStyles({"margin-top":"-24px","margin-left":"-27px"}).grab(new Element("div",{"class":"handleIconBgRight"})).grab(new Element("div",{"class":"handleArrow",style:"background-position: -48px 0"})).addClass("handleIcon").addEvent("click",b).addEvent("touchend",b);$("rightColumn_handle").addEvent("touchend",b).setStyle("overflow","visible")}else{jQuery(".gc-drag-n-drop-strip-right").click(function(){if(gcapp.rightcolumn&&gcapp.rightcolumn.isCollapsed){if(gcapp.rightcolumn){gcapp.rightcolumn.columnToggle()}}})}},initCentralPanel:function(a){if($("mainColumn")||$("mapPanel")){this.mappanel=this.loadPanel({id:"mapPanel",title:"Map",contentURL:fno.liveSite+"modules_gc/flashmap/flashmap.php?nch="+_nch,column:"mainColumn",collapsible:false,onContentLoaded:function(){gcapp.gcmap=new gcFlashMap()},onResize:function(){}})}var b={edit:fno.gcinit_auth.type};if(user.options.TOOLBAR_ELEMENTS){var d=user.options.TOOLBAR_ELEMENTS.split(",");if(d&&d.length>0){b.elements=d}}if(gcapp.options.mochaui){MUI.updateContent({element:gcapp.mappanel.panelEl,childElement:this.mappanel.panelHeaderContentEl,content:"<div id='map_area' ></div>",onContentLoaded:function(){gcapp.gctoolbar=new gcToolbar("map_area",b)}})}else{gcapp.gctoolbar=new gcToolbar("map_area",b)}if(this.options.mochaui){this.dataPanelResizeF=function(){if(gcdatagrid){gcdatagrid.lydata_onPanelResize()}};var c=this;this.dataPanel=this.loadPanel({id:"datagrid",title:gclang.Data,column:"mainColumn",height:200,collapsed:(c.options.saveState?!(1*localStorage["giscloud-datagrid-open"]):true),scrollbars:false,onContentLoaded:function(){gcdatagrid=new gcDataGrid({qsParams:{module:"layer",task:"getlayerdata"}})},onResize:function(){gcapp.dataPanelResizeF.call(this);gcapp.onResize()},onExpand:function(){if(c.options.saveState){localStorage["giscloud-datagrid-open"]=1}giscloud.log.push("datapanel_expand",{mid:currentMapID});if(gcdatagrid){gcdatagrid.lydata_onExpandPanel()}gcapp.onResize()},onCollapse:function(){if(c.options.saveState){localStorage["giscloud-datagrid-open"]=0}giscloud.log.push("datapanel_collapse",{mid:currentMapID});gcapp.onResize()}});if($("datagrid_title")){$("datagrid_title").addEvent("click",function(){gcapp.dataPanel.toggle()})}}else{gcdatagrid=new gcDataGrid({qsParams:{module:"layer",task:"getlayerdata"}})}},setAppState:function(a){var d,c,b;if(d=$("layers-panel_header")){d.overlay(!a)}if(d=$("gclayertree")){d.overlay(!a)}if(c=$("datagrid_header")){c.overlay(!a)}if(b=$("mapPanel_header")){b.overlay(!a)}if(this.ribbonMenu&&this.options.setRibbonState){if(a){gcapp.ribbonMenu.tabs.enableTab(1);gcapp.ribbonMenu.tabs.enableTab(2);gcapp.ribbonMenu.tabs.enableTab(3);gcapp.ribbonMenu.tabs.enableTab(4);gcapp.ribbonMenu.tabs.enableTab(5)}else{gcapp.ribbonMenu.tabs.disableTab(1);gcapp.ribbonMenu.tabs.disableTab(2);gcapp.ribbonMenu.tabs.disableTab(3);gcapp.ribbonMenu.tabs.disableTab(4);gcapp.ribbonMenu.tabs.disableTab(5);if(GOptions.get("GISCLOUD_EDITOR")==1&&currentMapID&&(d=$("ribbon").getElement(".ribbonpanel .tabdisabled"))){d.setStyle("left",(user.id==-1?0:70)+"px")}}}},mapChange:function(a){if(gcapp.ribbonMenu&&gcapp.ribbonMenu.tabs.currentTab==0&&$("home_tab")){gcapp.ribbonMenu.tabs.showTab(1);if(fno.mobilebrowser){gcapp.ribbonMenu.minimize()}}if(fno.mobilephone){jQuery("#signupcombo").addClass("signupcombo-mobile");jQuery("#signupcombo div.combolabel").addClass("combolabel-mobile")}if(gcapp.gclayer&&gcapp.gclayer.llist){gcapp.gclayer.llist.showLoader()}}});gcapp.addEvent("domready",function(){this.homepage=new gcHomePage();if(openMapId<0){this.homepage.show()}new omniCombo("combodiv_list",{changetitle:false,iframe:true});new omniCombo("combodiv_list2",{changetitle:false,iframe:true});new omniCombo("rb_layers_list",{changetitle:false,iframe:true});new omniCombo("rb_layers_list2",{changetitle:false,iframe:true});if(this.ribbonMenu){this.ribbonMenu.addEvent("change",this.changeRibbonTab.bind(this));this.refreshDatasources()}});gcapp.addEvent("uiinit",gcapp.initUI.bind(gcapp));gcapp.addEvent("ready",function(){if(window.globalNoInterface){return}gcproject.addEvent("mapchange",gcapp.mapChange.bind(this));gcapp.setAppState(false);if(user.id==0){this.ribbonMenu.tabs.showTab(6)}else{if(!(openMapId>0)){this.loadHomeWorkspace()}}gcproject.addEvent("getmapdata",function(c){if(!$("social_networks_area")){return}var a=escape(fn.getPermalink());var b=fn.getMap().name;$("social_networks_area").set("html",'<div class="customriba" style="margin-top:7px;"><iframe allowtransparency="true" frameborder="0" scrolling="no"src="http://platform.twitter.com/widgets/tweet_button.html?via=giscloud&url='+a+"&text=Check map "+escape(b)+' at " style="width:130px; height:20px;"></iframe> </div><iframe src="//www.facebook.com/plugins/like.php?href='+a+'&amp;send=false&amp;layout=standard&amp;width=280&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="margin-top:10px;border:none; overflow:hidden; width:280px; height:35px;" allowTransparency="true"></iframe>')})});
var gcHomePage=new Class({Extends:omModule,options:{defaultPerpage:20,perpage:20,page:1},initialize:function(b){this.homepage=$("homepage-container");if(!this.homepage){return}this.content=$("content_right_dynamic");this.mapinput=$("mapssearch");this.mi=new omniInput(this.mapinput,{delayedChange:true,minimumLength:0});this.mi.addEvent("delaychange",this.startMapSearch.bind(this));var d=this.homepage.getElements(".mainmenu li");var a=this;d.each(function(e,f){e.addEvent("click",function(g){a.mapinput.value="";var h=e.get("index");a.mainMenuClick(h,1)})});jQuery("#btn_group_map_types.btn-group .btn").hover(function(f){jQuery("#btn_group_map_types.btn-group ul.dropdown-menu").show()});var c=this;jQuery("#btn_group_map_types.btn-group li  a").click(function(f){c.currentMapsType=jQuery(f.currentTarget).html()});if(fno.wordpress_url){if(fno.blog_category_id){om.external(fno.wordpress_url+"get_category_posts/",{id:fno.blog_category_id}).done(function(f){f.posts=f.posts.slice(0,5);jQuery.each(f.posts,function(h,g){g.date_formatted=moment(g.date).fromNow()});var e=Handlebars.compile(jQuery("#blog_details_template").html());jQuery("#blog_content").empty().append(e(f))})}om.external((window.location.protocol=="https:"?"https:":"http:")+"//vimeo.com/api/v2/giscloud/videos.json").done(function(g){var f=null;jQuery.each(g,function(j,h){if(h.id=="73214603"){f=j;return}h.date_formatted=moment(h.upload_date).fromNow()});g.splice(f,1);g=g.slice(0,6);var e=Handlebars.compile(jQuery("#video_details_template").html());jQuery("#video_content").empty().append(e({videos:g}))})}},uploadData:function(a){giscloud.log.push("home_tab_upload_data");fileManager(true)},startMapSearch:function(b){var c=this.mi.getValue();var a={perpage:this.options.perpage,page:1,order_by:"accessed:desc",query_on:"name",query:c};if(fno.wuids){a.owner=fno.wuids}if(c.length>1){giscloud.log.push("home_tab_map_search",a);om.rest("maps",a,this.onGetMapsData.bind(this))}else{this.refresh()}},onGetMapsData:function(d){if(!this.homepage){return}this.content.hideLoader();if(!d){this.content.set("html","Error");return}else{if(d.data&&d.data.length==0){this.content.set("html","Sorry, there are no maps here.");return}}var g=jQuery("<div/>");jQuery("#content_right_dynamic").empty().append(g);var l=Math.ceil(d.total/this.options.perpage),k;this.currentmaps=[];var f=jQuery("<ul/>").addClass("maps").appendTo(g);if(fno.mobilephone){f.css("text-align","center")}for(var e=0;e<d.data.length;e++){var a=d.data[e];var j=jQuery("<li/>").addClass("gc-map-thumb").attr("title",a.name).data("map",a).click(this.openMap).appendTo(f);if(fno.mobilephone){j.addClass("maps-list-mobile-mode")}if(a.share=="t"){j.addClass("flag-public")}else{j.addClass("flag-private")}if(!gcproject.isMapAccessibleByPlan(a)){var c=jQuery("<div/>").addClass("limited-access").html("Limited access").appendTo(j)}var b='<div class="imdsg" >';b+='  <img src="'+fno.liveSite+"rest/1/maps/"+a.id+"/render.png?width=100&height=100&timestamp="+a.modified+'" />';b+='  <div class="gc-map-info" >';b+='     <div class="gc-label" >'+a.name+"</div>";if(user.id>0&&!(user.id!=a.owner.id&&a.share=="t")){b+='     <div class="gc-map-meta" >Owner: '+(user.username==a.owner.username?"Me":a.owner.username)+"</div>"}b+='     <div class="gc-map-meta" >Modified: '+moment(a.modified*1000).fromNow()+"</div>";b+="  </div>";b+="</div>";b=jQuery(b);j.append(b);this.currentmaps.push(a.id)}var k="<button class='btn btn-small btn-map-show-more' >Show more maps</button></p>",h=Math.ceil(d.total/this.options.perpage);g.append(jQuery("<div class='clear' ></div> <p class='text-center' >"+(h>d.page?k:"")));that=this;jQuery(".btn-map-show-more").click(function(){that.options.perpage+=that.options.defaultPerpage;that.refresh()})},openMapByIndex:function(b){if(!this.currentmaps||b<0||b>=this.currentmaps.length){return}var a=this.currentmaps[b];gcproject.mapChange(a)},gotoPage:function(a){this.options.page=a;this.refresh()},refresh:function(){if(!this.homepage){return}var b;var d=this.homepage.getElements(".mainmenu li");var a=this;var c=false;d.each(function(e,g){if(e.hasClass("active")){var f=e.get("index");a.mainMenuClick(f);c=true}});if(!c){this.mainMenuClick(0)}},openMap:function(a){var b=jQuery(a.currentTarget).data("map");if(user.active_subscription&&user.active_subscription.type==10&&b.owner.id!=user.id&&b.share=="f"){jQuery.each(b.owner.subscriptions,function(c,d){if(d.app_instance_id==fno.gcinit_editor_id){if(d.type==10){gcproject.mapChange(b.id)}else{mapNotAllowed()}}})}else{gcproject.mapChange(b.id)}},mainMenuClick:function(b,d){if(!this.homepage){return}var b=typeof b=="array"?b.join():b;jQuery(".mainmenu li").removeClass("active");jQuery(".mainmenu li")[b].addClass("active");this.content.empty();this.content.showLoader();if(d){this.options.page=d}var a={perpage:this.options.perpage,page:this.options.page,order_by:"accessed:desc"};var c=this.mi.getValue();if(c.length>1){a.query_on="name";a.query=c}switch(b*1){case 0:if(fno.wuids){a.owner=fno.wuids}break;case 1:a.type="private";break;case 2:a.type="shared";break;case 3:a.type="public";a.order_by="rating:desc,accessed:desc";if(fno.wuids){a.owner=fno.wuids}break}a.expand="owner,owner_subscription";giscloud.log.push("home_tab_map_list",a);om.rest("maps",a,this.onGetMapsData.bind(this),{method:"GET"})},show:function(){if(!this.homepage){return}this.homepage.show()},hide:function(){if(!this.homepage){return}this.homepage.hide()}});
gcapp.addEvent("domready",function(){if(!fno.gcinit_auth.logged||(user.options.DRAG_AND_DROP!==undefined&&user.options.DRAG_AND_DROP==0)){return}window.dragndropupload=new giscloud.ddupload(jQuery("body"));jQuery("body").bind("uploadstart",function(){var a=formManager.get("filemanager");if(a&&omnifilemanager&&omnifilemanager.getSourceType()=="file"){window.dragndropupload.upload_dir(omnifilemanager.getRelativeDir())}else{window.dragndropupload.upload_dir("")}});jQuery("body").bind("dropzoneenter",function(c){var b=formManager.get("filemanager");if(b&&omnifilemanager&&omnifilemanager.getSourceType()=="file"){var a=omnifilemanager.getRelativeDir();a=!a?"/":a;msg="Drop your files to upload to '"+a+"'";window.dragndropupload.accept(true)}else{if((gcapp.ribbonMenu&&gcapp.ribbonMenu.tabs.currentTab==0)||!gcproject.hasOpenProject()){msg="Drop files here to add in a new map"}else{if(gcproject.hasOpenProject()){if(editable){msg="Drop files here to add as layers";window.dragndropupload.accept(true)}else{msg="You don't have sufficient privileges to modify this map";window.dragndropupload.accept(false)}}else{msg="Drop files here to add in a new map"}}}window.dragndropupload.setMessage(msg)});jQuery("body").bind("uploadcomplete",function(d,j,b){if(!b||b.length==0){return}gcapp.check_subscription();var h=formManager.get("filemanager");if(h&&window.omnifilemanager){omnifilemanager.refreshFiles()}else{var a=["mif","shp","kml","tif","tiff"];function i(){var k;for(k=0;k<b.length;k++){var e=b[k];var l=e.name.substr(e.name.lastIndexOf(".")+1);if(jQuery.inArray(l,a)>=0){return true}}return false}if(!i()){return}function f(e,l){om.showLoader("Adding new layers...");var k=jQuery.map(b,function(n){var o=n.name.substr(n.name.lastIndexOf(".")+1);if(jQuery.inArray(o,a)>=0){var p=n.name.substr(0,n.name.indexOf("."));var m=j+"/"+n.name;giscloud.log.push("layer_create",{mid:e,filename:n.name,type:"dnd"});return giscloud.layers.create({name:p,mid:e,source:'{"type":"file","src":"'+m+'","name":"'+p+'"}'})}});jQuery.when.apply(jQuery,k).always(function(n,m,o){om.hideOverlay();om.hideLoader();giscloud.log.push("layer_create_completed",{mid:e,msg:n,type:"dnd"});if(l){gcproject.mapChange(e)}else{gcproject.reload(false,false,true)}})}if((gcapp.ribbonMenu&&gcapp.ribbonMenu.tabs.currentTab==0)||!gcproject.hasOpenProject()){var g=b[0].name;var c=g.substr(0,g.indexOf("."));om.showOverlay();om.showLoader("Creating new map...");giscloud.maps.create({name:c}).done(function(e){giscloud.log.push("map_create",{mid:e,type:"dnd"});f(e,true)})}else{if(gcproject.hasOpenProject()){f(currentMapID,false)}}}})});