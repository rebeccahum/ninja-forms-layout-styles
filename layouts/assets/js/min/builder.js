!function(){var e,t,l;!function(n){function o(e,t){return C.call(e,t)}function i(e,t){var l,n,o,i,r,a,s,d,c,u,h,f=t&&t.split("/"),g=m.map,p=g&&g["*"]||{};if(e&&"."===e.charAt(0))if(t){for(e=e.split("/"),r=e.length-1,m.nodeIdCompat&&j.test(e[r])&&(e[r]=e[r].replace(j,"")),e=f.slice(0,f.length-1).concat(e),c=0;c<e.length;c+=1)if(h=e[c],"."===h)e.splice(c,1),c-=1;else if(".."===h){if(1===c&&(".."===e[2]||".."===e[0]))break;c>0&&(e.splice(c-1,2),c-=2)}e=e.join("/")}else 0===e.indexOf("./")&&(e=e.substring(2));if((f||p)&&g){for(l=e.split("/"),c=l.length;c>0;c-=1){if(n=l.slice(0,c).join("/"),f)for(u=f.length;u>0;u-=1)if(o=g[f.slice(0,u).join("/")],o&&(o=o[n])){i=o,a=c;break}if(i)break;!s&&p&&p[n]&&(s=p[n],d=c)}!i&&s&&(i=s,a=d),i&&(l.splice(0,a,i),e=l.join("/"))}return e}function r(e,t){return function(){var l=w.call(arguments,0);return"string"!=typeof l[0]&&1===l.length&&l.push(null),f.apply(n,l.concat([e,t]))}}function a(e){return function(t){return i(t,e)}}function s(e){return function(t){y[e]=t}}function d(e){if(o(v,e)){var t=v[e];delete v[e],b[e]=!0,h.apply(n,t)}if(!o(y,e)&&!o(b,e))throw new Error("No "+e);return y[e]}function c(e){var t,l=e?e.indexOf("!"):-1;return l>-1&&(t=e.substring(0,l),e=e.substring(l+1,e.length)),[t,e]}function u(e){return function(){return m&&m.config&&m.config[e]||{}}}var h,f,g,p,y={},v={},m={},b={},C=Object.prototype.hasOwnProperty,w=[].slice,j=/\.js$/;g=function(e,t){var l,n=c(e),o=n[0];return e=n[1],o&&(o=i(o,t),l=d(o)),o?e=l&&l.normalize?l.normalize(e,a(t)):i(e,t):(e=i(e,t),n=c(e),o=n[0],e=n[1],o&&(l=d(o))),{f:o?o+"!"+e:e,n:e,pr:o,p:l}},p={require:function(e){return r(e)},exports:function(e){var t=y[e];return"undefined"!=typeof t?t:y[e]={}},module:function(e){return{id:e,uri:"",exports:y[e],config:u(e)}}},h=function(e,t,l,i){var a,c,u,h,f,m,C=[],w=typeof l;if(i=i||e,"undefined"===w||"function"===w){for(t=!t.length&&l.length?["require","exports","module"]:t,f=0;f<t.length;f+=1)if(h=g(t[f],i),c=h.f,"require"===c)C[f]=p.require(e);else if("exports"===c)C[f]=p.exports(e),m=!0;else if("module"===c)a=C[f]=p.module(e);else if(o(y,c)||o(v,c)||o(b,c))C[f]=d(c);else{if(!h.p)throw new Error(e+" missing "+c);h.p.load(h.n,r(i,!0),s(c),{}),C[f]=y[c]}u=l?l.apply(y[e],C):void 0,e&&(a&&a.exports!==n&&a.exports!==y[e]?y[e]=a.exports:u===n&&m||(y[e]=u))}else e&&(y[e]=l)},e=t=f=function(e,t,l,o,i){if("string"==typeof e)return p[e]?p[e](t):d(g(e,t).f);if(!e.splice){if(m=e,m.deps&&f(m.deps,m.callback),!t)return;t.splice?(e=t,t=l,l=null):e=n}return t=t||function(){},"function"==typeof l&&(l=o,o=i),o?h(n,e,t,l):setTimeout(function(){h(n,e,t,l)},4),f},f.config=function(e){return f(e)},e._defined=y,l=function(e,t,l){if("string"!=typeof e)throw new Error("See almond README: incorrect module build, no module name");t.splice||(l=t,t=[]),o(y,e)||o(v,e)||(v[e]=[e,t,l])},l.amd={jQuery:!0}}(),l("../lib/almond",function(){}),l("views/emptyCell",[],function(){var e=Marionette.ItemView.extend({tagname:"div",template:"#nf-tmpl-empty-cell"});return e}),l("views/cellItem",["views/emptyCell"],function(e){var t=Marionette.CollectionView.extend({tagname:"div",className:"layouts-cell",emptyView:e,dropping:!1,initialize:function(e){this.collection=this.model.get("fields"),this.childView=n.channel("views").request("get:fieldItem"),this.cellCollection=e.cellCollection},onRender:function(){jQuery(this.el).data("width",this.model.get("width")),jQuery(this.el).data("model",this.model),1==this.collection.models.length?(jQuery(this.el).addClass("single-field"),jQuery(this.el).removeClass("multi-field")):(jQuery(this.el).addClass("multi-field"),jQuery(this.el).removeClass("single-field")),1<this.cellCollection.length?(jQuery(this.el).addClass("layouts-droppable"),jQuery(this.el).addClass("nf-field-type-droppable")):(jQuery(this.el).removeClass("nf-field-type-droppable"),jQuery(this.el).removeClass("layouts-droppable")),this.initSortable()},initSortable:function(){var e=this;jQuery(this.el).sortable({cancel:".nf-item-controls",placeholder:"nf-fields-sortable-placeholder",opacity:.95,items:".nf-field-wrap, .nf-stage",tolerance:"pointer",connectWith:".layouts-droppable",refreshPositions:!0,appendTo:"#nf-main",helper:function(t){var l=n.channel("layouts").request("getHelper:cellSortable",t,e,this);return l},over:function(t,l){n.channel("layouts").trigger("over:cellSortable",t,l,e,this)},out:function(t,l){n.channel("layouts").trigger("out:cellSortable",t,l,e,this)},sort:function(t,l){n.channel("layouts").trigger("sort:cellSortable",t,l,e,this)},receive:function(t,l){l.item.dropping||n.channel("layouts").trigger("receive:cellSortable",t,l,e,this)},start:function(t,l){n.channel("layouts").trigger("start:cellSortable",t,l,e,this)},stop:function(t,l){n.channel("layouts").trigger("stop:cellSortable",t,l,e,this)},update:function(t,l){n.channel("layouts").trigger("update:cellSortable",t,l,e,this)}})},templateHelpers:function(){return{renderHandleBefore:function(){return'<div class="layouts-handle"></div>'},renderHandleAfter:function(){return'<div class="layouts-handle"></div>'}}},events:{"click .delete":"clickDeleteCell"},clickDeleteCell:function(e){n.channel("layouts").trigger("click:deleteCell",e,this)}});return t}),l("models/cellFieldCollection",[],function(){var e=Backbone.Collection.extend({comparator:"cellOrder",initialize:function(e,t){this.options=t,this.listenTo(n.channel("layouts-cell"),"remove:field",this.removeField),_.each(e,function(e){"undefined"!=typeof e&&e.set("cellcid",this.options.cellModel.cid,{silent:!0})},this),this.on("add",this.addField,this),this.on("remove",this.updateCellModel,this);var l=n.channel("fields").request("get:collection");l.on("remove",this.removeModel,this),l.on("add",this.addModel,this)},addField:function(e){if(e.set("cellcid",this.options.cellModel.cid,{silent:!0}),1==this.options.cellModel.collection.length){var t=this.options.cellModel.collection.options.rowModel.get("order");this.remove(e),n.channel("layouts").request("add:row",this.options.cellModel.collection.options.rowModel.collection,{order:t,field:e})}this.updateCellModel()},updateCellModel:function(){this.options.cellModel.set("fields",this),this.options.cellModel.trigger("change:fields",this.options.cellModel)},removeField:function(e){this.get(e)&&this.remove(this.get(e))},removeModel:function(e){this.remove(e)},addModel:function(e){"undefined"!=typeof this.options.cellModel&&this.options.cellModel.cid==e.get("cellcid")&&this.add(e)}});return e}),l("views/rowItem",["views/cellItem","models/cellFieldCollection"],function(e,t){var l=Marionette.CollectionView.extend({tagname:"div",className:"layouts-row",childView:e,reorderOnSort:!0,initialize:function(){this.collection=this.model.get("cells"),this.childViewOptions={cellCollection:this.collection},n.channel("layouts").reply("update:gutters",this.updateGutters,this),this.collection.on("sort",this.render,this),jQuery("#nf-builder").on("mousedown",function(){jQuery(this).data("mousedown",!0)}),jQuery("#nf-builder").on("mouseup",function(){jQuery(this).data("mousedown",!1)})},onBeforeDestroy:function(){this.collection.off("sort",this.maybeRender)},maybeRender:function(){1<this.collection.models.length&&this.render()},onRender:function(){jQuery(this.el).prop("id",this.model.cid),1==this.collection.models.length?(jQuery(this.el).addClass("single-cell"),jQuery(this.el).removeClass("multi-cell")):(jQuery(this.el).addClass("multi-cell"),jQuery(this.el).removeClass("single-cell")),jQuery(this.el).find(".gutter").remove(),this.updateGutters();var e=this;jQuery(this.el).find(".gutter").droppable({tolerance:"pointer",hoverClass:"nf-fields-sortable-placeholder",accept:".nf-field-type-draggable, .nf-field-wrap, .nf-stage",over:function(t,l){n.channel("layouts").trigger("over:gutterDroppable",t,l,e,this)},out:function(t,l){n.channel("layouts").trigger("out:gutterDroppable",t,l,e,this)},drop:function(t,l){n.channel("layouts").trigger("drop:gutterDroppable",t,l,e,this)}})},updateGutters:function(){var e=jQuery(this.el).find(".layouts-cell"),t=this;Split(e,{minSize:50,cellCollection:t.collection,onDragStart:function(e){n.channel("layouts").trigger("dragStart:gutterSlider",e,t.collection)},onDrag:function(e){n.channel("layouts").trigger("drag:gutterSlider",e,t.collection)},onDragEnd:function(e){n.channel("layouts").trigger("dragEnd:gutterSlider",e,t.collection)}}),_.each(jQuery(e),function(t,l){var n=jQuery(t).data("width"),o=10;0==l||l==jQuery(e).length-1,jQuery(t).css("width","calc("+n+"% - "+o+"px)")});var l='<div class="gutter" style="width: 10px; cursor: ew-resize;"></div>';jQuery(this.el).find(".layouts-cell:first").before(l),jQuery(this.el).find(".layouts-cell:last").after(l)}});return l}),l("views/rowCollection",["views/rowItem"],function(e){var t=Marionette.CollectionView.extend({tagname:"div",className:"layouts-row-collection layouts-droppable nf-field-type-droppable nf-fields-sortable",childView:e,reorderOnSort:!0,getEmptyView:function(){return n.channel("views").request("get:mainContentEmpty")},initialize:function(){this.collection.on("add",this.maybeInitSortable,this)},onBeforeDestroy:function(){this.collection.off("add",this.maybeInitSortable)},onRender:function(){this.maybeInitSortable()},maybeInitSortable:function(){0<this.collection.models.length&&this.initSortable()},initSortable:function(){var e=this;jQuery(this.el).sortable({helper:"clone",handle:".gutter:first",items:".layouts-row",cancel:".layouts-cell",tolerance:"pointer",placeholder:"nf-fields-sortable-placeholder",appendTo:"#nf-main",grid:[5,5],start:function(t,l){n.channel("layouts").trigger("start:rowsSortable",t,l,e,this)},stop:function(t,l){n.channel("layouts").trigger("stop:rowsSortable",t,l,e,this)},over:function(t,l){n.channel("layouts").trigger("over:rowsSortable",t,l,e,this)},out:function(t,l){n.channel("layouts").trigger("out:rowsSortable",t,l,e,this)},receive:function(t,l){l.item.dropping||n.channel("layouts").trigger("receive:rowsSortable",t,l,e,this)},update:function(t,l){n.channel("layouts").trigger("update:rowsSortable",t,l,e,this)}})}});return t}),l("models/cellModel",["models/cellFieldCollection"],function(e){var t=Backbone.Model.extend({initialize:function(){var t=n.channel("fields").request("get:collection"),l=[];_.each(this.get("fields"),function(e){"undefined"==typeof t.get(e)?l.push(t.findWhere({key:e})):l.push(t.get(e))}),!1==this.get("fields")instanceof Backbone.Collection&&this.set("fields",new e(l,{cellModel:this}))}});return t}),l("models/cellCollection",["models/cellModel"],function(e){var t=Backbone.Collection.extend({model:e,comparator:"order",initialize:function(e,t){this.options=t,this.on("change:fields",this.updateRowModel,this),this.on("add",this.addCell,this),this.on("remove",this.updateCellWidths,this)},addCell:function(){this.updateCellWidths(),this.updateRowModel(),this.options.rowModel.trigger("add:cell",this.options.rowModel)},updateRowModel:function(){this.options.rowModel.set("cells",this),this.options.rowModel.trigger("change:cells",this.options.rowModel)},updateCellWidths:function(e){var t=Math.round(100/this.models.length);_.each(this.models,function(e){e.set("width",t)}),this.sort()}});return t}),l("models/rowModel",["models/cellCollection"],function(e){var t=Backbone.Model.extend({initialize:function(t,l){this.options=l,this.set("cells",new e(this.get("cells"),{rowModel:this})),this.on("change:cells",this.checkEmptyCells,this)},checkEmptyCells:function(e){var t=!0;_.each(this.get("cells").models,function(e){0!=e.get("fields").length&&(t=!1)}),t&&"undefined"!=typeof this.collection&&this.collection.remove(this)}});return t}),l("models/rowCollection",["models/rowModel"],function(e){var t=Backbone.Collection.extend({model:e,comparator:"order",initialize:function(e){this.updateMaxCols(e),this.on("add:cell",this.updateMaxCols,this),this.on("destroy:cell",this.updateMaxCols,this),this.on("remove:cell",this.updateMaxCols,this),this.on("destroy",this.updateMaxCols,this),this.on("add:field",this.addField,this),this.on("append:field",this.appendField,this),this.on("remove:field",this.removeField,this)},updateMaxCols:function(e){var t=1;!0==e instanceof Backbone.Model&&(e=this.models),_.each(e,function(e){"undefined"!=typeof e.cells?t<e.cells.length&&(t=e.cells.length):!0==e instanceof Backbone.Model&&t<e.get("cells").length&&(t=e.get("cells").length)}),n.channel("layouts").request("update:colClass",t)},addField:function(e){if(!e.get("oldCellcid"))return this.appendField(e),!1;var t=!1;this.every(function(l){return l.get("cells").get({cid:e.get("oldCellcid")})?(t=l.get("cells").get({cid:e.get("oldCellcid")}),!1):!0}),t?(t.get("fields").add(e),t.collection.sort()):this.appendField(e),e.set("oldCellcid",!1)},removeField:function(e){e.get("oldCellcid")||e.set("oldCellcid",e.get("cellcid")),n.channel("layouts-cell").trigger("remove:field",e.get("id"))},appendField:function(e){var t=9999;this.add({order:t,cells:[{order:0,fields:[e.get("key")],width:"100"}]})}});return t}),l("controllers/data",["models/rowCollection"],function(e){var t=Marionette.Object.extend({overSortable:!1,outFired:!1,overCell:!1,overRows:!1,initialize:function(){n.channel("layouts").reply("add:row",this.addRow,this)},addRow:function(t,l){if(!t&&(t=n.channel("settings").request("get:setting","formContentData")||n.channel("settings").request("get:setting","fieldContentsData"),!1==t instanceof e))return!1;"undefined"==typeof l.order&&(l.order=999);var o=t.add({order:l.order,cells:[{order:0,fields:[l.field],width:"100"}]});return o},updateOverSortable:function(e){this.overSortable=e},getOverSortable:function(){return this.overSortable},updateOutFired:function(e){this.outFired=e},getOutFired:function(){return this.outFired},updateOverCell:function(e){this.overCell=e},getOverCell:function(){return this.overCell}});return t}),l("controllers/maxCols",[],function(){var e=Marionette.Object.extend({initialize:function(){n.channel("layouts").reply("update:colClass",this.updateColClass)},updateColClass:function(e){var t=n.channel("app").request("get:builderEl");if(jQuery(t).removeClass("few several many"),3==e)var l="few";else if(e>=4&&5>=e)var l="several";else if(e>=6)var l="many";else var l="";jQuery(t).addClass(l)}});return e}),l("controllers/addField",[],function(){var e=Marionette.Object.extend({initialize:function(){var e=n.channel("fields").request("get:collection");e.on("add",this.maybeAddRow,this),this.listenTo(n.channel("drawer-addField"),"startDrag:type",this.startDragging),this.listenTo(n.channel("drawer-addField"),"stopDrag:type",this.stopDragging),this.listenTo(n.channel("drawer-addField"),"startDrag:fieldStaging",this.startDragging),this.listenTo(n.channel("drawer-addField"),"stopDrag:fieldStaging",this.stopDragging)},maybeAddRow:function(e){if(!e.get("cellcid")){var t=e.get("order")?e.get("order"):999;n.channel("layouts").request("add:row",null,{order:t,field:e})}},startDragging:function(e){jQuery(".layouts-row").addClass("dragging"),jQuery("#nf-builder").addClass("layouts-dragging")},stopDragging:function(e){jQuery(".layouts-row").removeClass("dragging"),jQuery("#nf-builder").removeClass("layouts-dragging")}});return e}),l("controllers/cellSortable",[],function(){var e=Marionette.Object.extend({dropping:!1,initialize:function(){n.channel("layouts").reply("getHelper:cellSortable",this.getHelper,this),this.listenTo(n.channel("layouts"),"over:cellSortable",this.over),this.listenTo(n.channel("layouts"),"out:cellSortable",this.out),this.listenTo(n.channel("layouts"),"sort:cellSortable",this.sort),this.listenTo(n.channel("layouts"),"start:cellSortable",this.start),this.listenTo(n.channel("layouts"),"stop:cellSortable",this.stop),this.listenTo(n.channel("layouts"),"update:cellSortable",this.update),this.listenTo(n.channel("layouts"),"receive:cellSortable",this.receive),this.listenTo(n.channel("drawer-addField"),"drag:type",this.dragFieldType),this.listenTo(n.channel("layouts"),"set:dropping",this.setDropping),this.listenTo(n.channel("layouts"),"click:deleteCell",this.deleteCell)},over:function(e,t,l,o){jQuery(t.helper).css("width",jQuery(o).css("width")),jQuery("#nf-main").find(".gutter.nf-fields-sortable-placeholder").removeClass("nf-fields-sortable-placeholder"),1==l.collection.models.length&&1==l.cellCollection.length&&(jQuery(o).parent().find(".nf-fields-sortable-placeholder").addClass("nf-placeholder-removed").removeClass("nf-fields-sortable-placeholder"),jQuery(o).parent().find(".nf-placeholder-removed").prev().css("margin-bottom","0")),n.channel("app").request("over:fieldsSortable",t)},out:function(e,t,l,o){n.channel("app").request("out:fieldsSortable",t),1==l.collection.models.length&&1==l.cellCollection.length&&(jQuery(o).parent().find(".nf-placeholder-removed").prev().css("margin-bottom",""),jQuery(o).parent().find(".nf-placeholder-removed").addClass("nf-fields-sortable-placeholder").removeClass("nf-placeholder-removed"))},sort:function(e,t,l,n){},start:function(e,t,l,o){t.item.fieldCollection=l.collection,jQuery(".layouts-row").addClass("dragging"),jQuery("#nf-builder").addClass("layouts-dragging"),n.channel("app").request("start:fieldsSortable",t),this.dropping&&n.channel("layouts").trigger("set:dropping",!1)},stop:function(e,t,l,o){jQuery(".layouts-row").removeClass("dragging"),jQuery("#nf-builder").removeClass("layouts-dragging"),n.channel("app").request("stop:fieldsSortable",t)},update:function(e,t,l,o){if(o===t.item.parent()[0]){var i=jQuery(t.item).data("id"),r=n.channel("fields").request("get:field",i),a=jQuery(o).sortable("toArray"),s=[];_.each(l.collection.models,function(e){var t=e.get("id");if(jQuery.isNumeric(t))var l="field-"+t;else var l=t;var n=a.indexOf(l)+1;s[e.get("cellOrder")]=e.get("id"),e.set("cellOrder",n)}),l.collection.sort(),n.channel("layouts").request("update:fieldOrder",l.options.cellCollection.options.rowModel.collection),n.channel("app").request("update:setting","clean",!1),n.channel("app").request("update:db");var d={object:"Field",label:r.get("label"),change:"Re-ordered",dashicon:"sort"},c={layouts:!0,oldOrder:s,fieldCollection:l.collection},u=n.channel("changes").request("get:collection");_.each(u.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this);n.channel("changes").request("register:change","cellSorting",r,null,d,c)}},receive:function(e,t,l,o){return this.dropping?(n.channel("layouts").trigger("set:dropping",!1),!1):(jQuery(t.item).hasClass("nf-field-wrap")?this.receiveCurrentField(e,t,l,o):jQuery(t.item).hasClass("nf-field-type-draggable")?this.receiveNewField(e,t,l,o):this.receiveFieldStaging(e,t,l,o),n.channel("layouts").request("update:fieldOrder",l.options.cellCollection.options.rowModel.collection),n.channel("app").request("update:setting","clean",!1),void n.channel("app").request("update:db"))},receiveNewField:function(e,t,l,o){var i=jQuery(t.item).data("id"),r=this.addField(i,l.model.cid);jQuery(t.helper).prop("id",r.get("id"));var a=jQuery(o).sortable("toArray");this.sortFields(a,l.model.get("fields")),n.channel("fields").trigger("drop:fieldType",i,r),jQuery(t.helper).remove()},receiveFieldStaging:function(e,t,l,o){n.channel("fields").request("sort:staging");var i=n.channel("fields").request("get:staging"),r=jQuery(o).sortable("toArray"),a=r.indexOf("nf-staged-fields-drag");r.splice(a,1);_.each(i.models,function(e,t){var n=this.addField(e.get("slug"),l.model.cid);r.splice(a+t,0,n.get("id"))},this),this.sortFields(r,l.model.get("fields")),n.channel("fields").request("clear:staging"),jQuery(t.helper).remove()},receiveCurrentField:function(e,t,l,o){var i=jQuery(t.item).data("id"),r=n.channel("fields").request("get:field",i),a=[];_.each(t.item.fieldCollection.models,function(e,t){a[e.get("cellOrder")]=e.get("id")});var s=[];_.each(l.collection.models,function(e,t){s[e.get("cellOrder")]=e.get("id")}),l.collection.add(r);var d=jQuery(o).sortable("toArray");this.sortFields(d,l.collection),t.item.fieldCollection.remove(r);var c={object:"Field",label:r.get("label"),change:"Moved Between Cells",dashicon:"randomize"},u={layouts:!0,originalCollection:t.item.fieldCollection,newCollection:l.collection,senderOldOrder:a,receiverOldOrder:s},h=n.channel("changes").request("get:collection");_.each(h.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this);n.channel("changes").request("register:change","movedBetweenCells",r,null,c,u)},sortFields:function(e,t){_.each(t.models,function(t){var l=(t.get("cellOrder"),t.get("id"));if(jQuery.isNumeric(l))var n="field-"+l;else var n=l;var o=e.indexOf(n)+1;t.set("cellOrder",o)}),t.sort()},getHelper:function(e,t,l){if(jQuery(e.target).hasClass("nf-field-label")||jQuery(e.target).hasClass("fa"))var n=jQuery(e.target).parent();else if(jQuery(e.target).hasClass("required"))var n=jQuery(e.target).parent().parent();else var n=e.target;var o=jQuery(n).width(),i=jQuery(n).height(),r=jQuery(n).clone(),a=o/4,s=i/2;return jQuery(l).sortable("option","cursorAt",{top:s,left:a}),r},addField:function(e,t,l){l=l||!1;var o=n.channel("fields").request("get:type",e),i=n.channel("fields").request("get:tmpID"),r=n.channel("fields").request("add",{id:i,label:o.get("nicename"),type:e,cellcid:t},l,!1),a={object:"Field",label:r.get("label"),change:"Added",dashicon:"plus-alt"},s={layouts:!0,collection:n.channel("fields").request("get:collection")},d=n.channel("changes").request("get:collection");return _.each(d.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this),n.channel("changes").request("register:change","cellNewField",r,null,a,s),r},dragFieldType:function(e,t,l){if(t.helper.hasClass("nf-field-type-button")){var n=jQuery(e).draggable("instance");jQuery(t.helper).css("width",n.helperProportions.width)}},setDropping:function(e){this.dropping=e},deleteCell:function(e,t){var l=t.model,o=t.model.collection,i=t.model.collection.options.rowModel,r=i.collection;o.remove(l);var a={layouts:!0,rowCollection:r,cellCollection:o,cellModel:l,rowModel:i};if(1==o.models.length){var s=i.get("order"),d=[];_.each(o.models[0].get("fields").models,function(e){var t=n.channel("layouts").request("add:row",o.options.rowModel.collection,{order:s,field:e.get("id")});d.push(t)},this),r.remove(i),a.newRows=d}var c={object:"Cell",label:"",change:"Removed",dashicon:"dismiss"},u=n.channel("changes").request("get:collection");_.each(u.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this),n.channel("changes").request("register:change","removedCell",l,null,c,a),n.channel("app").request("update:setting","clean",!1),n.channel("app").request("update:db")}});return e}),l("controllers/gutterDroppable",[],function(){var e=Marionette.Object.extend({dropped:!1,initialize:function(){this.listenTo(n.channel("layouts"),"over:gutterDroppable",this.over),this.listenTo(n.channel("layouts"),"out:gutterDroppable",this.out),this.listenTo(n.channel("layouts"),"drop:gutterDroppable",this.drop),this.listenTo(n.channel("layouts"),"dragStart:gutterSlider",this.dragStart),this.listenTo(n.channel("layouts"),"drag:gutterSlider",this.drag),this.listenTo(n.channel("layouts"),"dragEnd:gutterSlider",this.dragEnd)},over:function(e,t,l,n){this.dropped=!1,jQuery(t.helper).hasClass("nf-field-type-draggable")?(jQuery(t.helper).css("width",300),jQuery("#nf-main").find(".nf-fields-sortable-placeholder:not(.gutter)").addClass("nf-sortable-removed").removeClass("nf-fields-sortable-placeholder")):(jQuery(n).addClass("nf-fields-sortable-placeholder"),jQuery("#nf-main").find(".nf-fields-sortable-placeholder:not(.gutter)").addClass("nf-sortable-removed").removeClass("nf-fields-sortable-placeholder"))},out:function(e,t,l,n){jQuery(t.helper).hasClass("nf-field-type-draggable")?jQuery("#nf-main").find(".nf-sortable-removed").addClass("nf-fields-sortable-placeholder"):(jQuery(n).removeClass("nf-fields-sortable-placeholder"),jQuery("#nf-main").find(".nf-sortable-removed").addClass("nf-fields-sortable-placeholder"))},drop:function(e,t,l,o){if(jQuery("#nf-builder").data("mousedown")||this.dropped)return!1;this.dropped=!0,n.channel("layouts").trigger("set:dropping",!0);var i=jQuery(o).index()/2,r=this.addCell(i,l.collection);jQuery(t.helper).hasClass("nf-field-type-draggable")?this.dropNewField(e,t,l,o,r):jQuery(t.helper).hasClass("nf-stage")?this.dropFieldStaging(e,t,l,o,r):this.dropCurrentField(e,t,l,o,r),n.channel("layouts").request("update:fieldOrder",l.model.collection),n.channel("app").request("update:setting","clean",!1),n.channel("app").request("update:db"),jQuery("#nf-main").find(".nf-sortable-removed").addClass("nf-fields-sortable-placeholder"),l.render()},dropNewField:function(e,t,l,n,o){var i=jQuery(t.draggable).data("id");this.addField(i,o,!1);jQuery(t.helper).remove()},dropFieldStaging:function(e,t,l,o,i){n.channel("fields").request("sort:staging");var r=n.channel("fields").request("get:staging");_.each(r.models,function(e,t){this.addField(e.get("slug"),i)},this),n.channel("fields").request("clear:staging"),jQuery(t.helper).remove()},dropCurrentField:function(e,t,l,o,i){var r=jQuery(t.draggable).data("id"),a=n.channel("fields").request("get:field",r),s=t.draggable.fieldCollection;i.get("fields").add(a),t.draggable.fieldCollection.remove(a),jQuery(t.draggable).remove();var d={object:"Field",label:a.get("label"),change:"New Cell",dashicon:"image-flip-horizontal"},c={layouts:!0,oldCollection:s,newCell:i,cellCollection:l.collection},u=n.channel("changes").request("get:collection");_.each(u.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this);n.channel("changes").request("register:change","gutterSplitCell",a,null,d,c)},dragStart:function(e,t){var l=this.getDraggedWidths(e,t),n=l.a,o=l.b;jQuery(e.gutter).append('<span class="percent-left">'+n+'%</span><span class="percent-right">'+o+"%</span>")},drag:function(e,t){var l=this.getDraggedWidths(e,t),n=l.a,o=l.b;jQuery(e.gutter).find(".percent-left").html(n+"%"),jQuery(e.gutter).find(".percent-right").html(o+"%")},dragEnd:function(e,t){var l=this.getDraggedWidths(e,t),o=l.a,i=l.b,r=jQuery(e.a).data("model"),a=jQuery(e.b).data("model"),s=r.get("width"),d=a.get("width");if(jQuery(e.gutter).find(".percent-left").remove(),jQuery(e.gutter).find(".percent-right").remove(),s==o&&d==i)return!1;r.set("width",o),a.set("width",i);var c={object:"Cells",label:"",change:"Resized",dashicon:"editor-code"},e={layouts:!0,gutter:e.gutter,cellCollection:t,modelA:r,oldModelAWidth:s,modelB:a,oldModelBWidth:d},u=n.channel("changes").request("get:collection");_.each(u.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this),n.channel("changes").request("register:change","gutterResize",r,null,c,e),n.channel("app").request("update:setting","clean",!1),n.channel("app").request("update:db")},addField:function(e,t,l){l=l||!1,renderField=!1;var o=n.channel("fields").request("get:type",e),i=n.channel("fields").request("get:tmpID"),r=n.channel("fields").request("add",{id:i,label:o.get("nicename"),type:e,cellcid:t.cid},l,renderField),a={object:"Field / Cell",label:r.get("label"),change:"Added",dashicon:"plus-alt"},s={layouts:!0,fieldCollection:n.channel("fields").request("get:collection"),newCell:t},d=n.channel("changes").request("get:collection");return _.each(d.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this),n.channel("changes").request("register:change","gutterDropNewField",r,null,a,s),r},addCell:function(e,t,l){var l=l||[];_.each(t.models,function(t){t.get("order")>=e&&t.set("order",t.get("order")+1)});var n=t.add({order:e,fields:l,width:""});return n},getDraggedWidths:function(e,t){var l=jQuery(e.a).data("width"),n=jQuery(e.b).data("width");return{a:l,b:n}}});return e}),l("controllers/rowsSortable",[],function(){var e=Marionette.Object.extend({dropping:!1,initialize:function(){this.listenTo(n.channel("layouts"),"over:rowsSortable",this.over),this.listenTo(n.channel("layouts"),"out:rowsSortable",this.out),this.listenTo(n.channel("layouts"),"start:rowsSortable",this.start),this.listenTo(n.channel("layouts"),"stop:rowsSortable",this.stop),this.listenTo(n.channel("layouts"),"update:rowsSortable",this.update),this.listenTo(n.channel("layouts"),"receive:rowsSortable",this.receive),this.listenTo(n.channel("layouts"),"set:dropping",this.setDropping)},start:function(e,t,l,o){this.dropping&&n.channel("layouts").trigger("set:dropping",!1),n.channel("app").request("start:fieldsSortable",t)},over:function(e,t,l,o){jQuery(t.helper).css("width",jQuery(o).css("width")),n.channel("app").request("over:fieldsSortable",t)},out:function(e,t,l,o){n.channel("app").request("out:fieldsSortable",t)},stop:function(e,t,l,o){n.channel("app").request("stop:fieldsSortable",t)},update:function(e,t,l,o){if(!jQuery(t.item).hasClass("nf-stage")&&!jQuery(t.item).hasClass("nf-field-wrap")&&!this.dropping){var i=jQuery(o).sortable("toArray"),r=[];_.each(i,function(e,t){r[l.collection.get({cid:e}).get("order")]=e,l.collection.get({cid:e}).set("order",t+1)}),l.collection.sort(),n.channel("layouts").request("update:fieldOrder",l.collection);var a=jQuery(t.item).data("id"),s=l.collection.get({cid:a}),d={object:"Row",label:"",change:"Re-ordered",dashicon:"sort"},c={layouts:!0,oldOrder:r,rowCollection:l.collection},u=n.channel("changes").request("get:collection");_.each(u.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this);n.channel("changes").request("register:change","rowSorting",s,null,d,c);n.channel("app").request("update:setting","clean",!1),n.channel("app").request("update:db")}},receive:function(e,t,l,o){return this.dropping?(n.channel("layouts").trigger("set:dropping",!1),!1):(jQuery(t.item).hasClass("nf-field-wrap")?this.receiveCurrentField(e,t,l,o):jQuery(t.item).hasClass("nf-field-type-draggable")?this.receiveNewField(e,t,l,o):jQuery(t.item).hasClass("nf-stage")&&this.receiveFieldStaging(e,t,l,o),n.channel("layouts").request("update:fieldOrder",l.collection),n.channel("app").request("update:setting","clean",!1),void n.channel("app").request("update:db"))},receiveNewField:function(e,t,l,o){var i=t.helper.index()+1,r=jQuery(t.item).data("id"),a=this.addField(r,i,!0);this.addRow(i,l.collection,[a.get("key")],!0),jQuery(t.helper).remove();var s={object:"Field",label:a.get("label"),change:"Added",dashicon:"plus-alt"},d={layouts:!0,collection:n.channel("fields").request("get:collection")},c=n.channel("changes").request("get:collection");_.each(c.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&e.set("disabled",!0)},this);n.channel("changes").request("register:change","rowNewField",a,null,s,d)},receiveFieldStaging:function(e,t,l,o){var i=t.helper.index()+1;n.channel("fields").request("sort:staging");var r=n.channel("fields").request("get:staging");_.each(r.models,function(e,t){var n=this.addField(e.get("slug"),i,!0);this.addRow(i,l.collection,[n.get("id")]),i++},this),n.channel("fields").request("clear:staging"),jQuery(t.helper).remove()},receiveCurrentField:function(e,t,l,o){var i=t.item.fieldCollection.options.cellModel.collection.options.rowModel.cid,r=jQuery(t.item).index()+1,a=jQuery(t.item).data("id"),s=[];_.each(l.collection.models,function(e){s[e.get("order")]=e.cid});var d=n.channel("fields").request("get:field",a);t.item.fieldCollection.remove(d);var c=this.addRow(r,l.collection,[a]);s[s.indexOf(i)]=c.cid;var u={object:"Field",undoLabel:d.get("label")},h={layouts:!0};if(2<=t.item.fieldCollection.options.cellModel.collection.length){var f="movedToNewRow",g=d;h.originalCollection=t.item.fieldCollection,h.rowModel=c,u.dashicon="randomize",u.change="Moved"}else{var f="rowSorting",g=c;h.oldOrder=s,h.rowCollection=l.collection,u.dashicon="sort",u.change="Re-ordered"}var p=n.channel("changes").request("get:collection");_.each(p.models,function(e){var t=e.get("data");"undefined"!=typeof t.layouts&&t.layouts&&(e.set("disabled",!0),"undefined"!=typeof t.oldOrder&&(t.oldOrder[t.oldOrder.indexOf(i)]=c.cid,
e.set("data",t)))},this);n.channel("changes").request("register:change",f,g,null,u,h)},addRow:function(e,t,l,n){var l=l||[],n=n||!1;_.each(t.models,function(t){if(parseInt(t.get("order"))>=e){var l=t.get("order")+1;t.set("order",l)}});var o=t.add({order:e,cells:[{order:0,fields:l,width:"100"}]},{silent:n});return t.sort({silent:!0}),_.each(t.models,function(e,t){e.set("order",t+1)}),t.sort(),o},addField:function(e,t,l){l=l||!1;var o=n.channel("fields").request("get:type",e),i=n.channel("fields").request("add",{label:o.get("nicename"),type:e},l,!1);return i},setDropping:function(e){this.dropping=e}});return e}),l("controllers/undo",[],function(){var e=Marionette.Object.extend({initialize:function(){n.channel("changes").reply("undo:movedBetweenCells",this.undoMovedBetweenCells,this),n.channel("changes").reply("undo:gutterDropNewField",this.undoGutterDropNewField,this),n.channel("changes").reply("undo:gutterSplitCell",this.undoGutterSplitCell,this),n.channel("changes").reply("undo:cellSorting",this.undoCellSorting,this),n.channel("changes").reply("undo:removedCell",this.undoRemovedCell,this),n.channel("changes").reply("undo:cellNewField",this.undoCellNewField,this),n.channel("changes").reply("undo:rowNewField",this.undoRowNewField,this),n.channel("changes").reply("undo:gutterResize",this.undoGutterResize,this),n.channel("changes").reply("undo:movedToNewRow",this.undoMovedToNewRow,this),n.channel("changes").reply("undo:rowSorting",this.undoRowSorting,this)},undoMovedBetweenCells:function(e,t){var l=e.get("model"),n=e.get("data").senderOldOrder,o=e.get("data").receiverOldOrder,i=e.get("data").originalCollection,r=e.get("data").newCollection;i.add(l),_.each(i.models,function(e){var t=e.get("id"),l=n.indexOf(t);e.set("cellOrder",l)}),i.sort(),r.remove(l),_.each(r.models,function(e){var t=e.get("id"),l=o.indexOf(t);e.set("cellOrder",l)}),r.sort(),this.maybeRemoveChange(e,t),this.enableNextChange()},undoGutterDropNewField:function(e,t){var l=e.get("model"),n=e.get("data").fieldCollection,o=e.get("data").newCell;n.remove(l),0==o.get("fields").models.length&&o.collection.remove(o),this.maybeRemoveChange(e,t),this.enableNextChange()},undoGutterSplitCell:function(e,t){var l=e.get("model"),o=e.get("data").oldCollection,i=e.get("data").newCell,r=e.get("data").cellCollection;if("undefined"==typeof o.options.cellModel.collection.options.rowModel.collection){var a=o.options.cellModel.collection.options.rowModel.get("order");n.channel("layouts").request("add:row",r.options.rowModel.collection,{order:a,field:l.get("id")})}else o.add(l);i.get("fields").remove(l),r.remove(i),r.sort(),this.maybeRemoveChange(e,t),this.enableNextChange()},undoCellSorting:function(e,t){var l=e.get("data"),n=l.fieldCollection,o=l.oldOrder;_.each(n.models,function(e){var t=e.get("id"),l=o.indexOf(t);e.set("cellOrder",l)}),n.sort(),this.maybeRemoveChange(e,t),this.enableNextChange()},undoRemovedCell:function(e,t){var l=e.get("data"),n=l.cellModel,o=l.cellCollection,i=l.rowModel,r=l.rowCollection;if(o.add(n),"undefined"!=typeof l.newRows){var a=l.newRows;r.remove(a),r.add(i)}this.maybeRemoveChange(e,t),this.enableNextChange()},undoCellNewField:function(e,t){var l=e.get("model"),n=e.get("data").collection;n.remove(l),this.maybeRemoveChange(e,t),this.enableNextChange()},undoRowNewField:function(e,t){var l=e.get("model"),n=e.get("data").collection;n.remove(l),this.maybeRemoveChange(e,t),this.enableNextChange()},undoGutterResize:function(e,t){var l=e.get("data"),n=l.gutter,o=l.cellCollection,i=l.modelA,r=l.modelB,a=l.oldModelAWidth,s=l.oldModelBWidth;i.set("width",a),r.set("width",s),jQuery(n).find(".percent-left").remove(),jQuery(n).find(".percent-right").remove(),o.sort(),this.maybeRemoveChange(e,t),this.enableNextChange()},undoMovedToNewRow:function(e,t){var l=e.get("model"),n=e.get("data").originalCollection;n.add(l);var o=e.get("data").rowModel;o.collection.remove(o),this.maybeRemoveChange(e,t),this.enableNextChange()},undoRowSorting:function(e,t){var l=e.get("data").oldOrder,n=e.get("data").rowCollection;_.each(n.models,function(e){var t=e.cid,n=l.indexOf(t);e.set("order",n)}),n.sort(),this.maybeRemoveChange(e,t),this.enableNextChange()},enableNextChange:function(){var e=n.channel("changes").request("get:collection"),t=!1;_.each(e.models,function(e){var l=e.get("data");!t&&"undefined"!=typeof l.layouts&&l.layouts&&(e.set("disabled",!1),t=!0)},this)},maybeRemoveChange:function(e,t){var t="undefined"!=typeof t?t:!1;if(!t){n.channel("app").request("update:db");var l=n.channel("changes").request("get:collection");l.remove(e),0==l.length&&(n.channel("app").request("update:setting","clean",!0),n.channel("app").request("close:drawer"))}}});return e}),l("controllers/updateFieldOrder",[],function(){var e=Marionette.Object.extend({initialize:function(){n.channel("layouts").reply("update:fieldOrder",this.updateFieldOrder)},updateFieldOrder:function(e){var t=1;_.each(e.models,function(e,l){_.each(e.get("cells").models,function(e,l){_.each(e.get("fields").models,function(e,l){e.set("order",t,{silent:!0}),t++})})})}});return e}),l("controllers/loadControllers",["controllers/data","controllers/maxCols","controllers/addField","controllers/cellSortable","controllers/gutterDroppable","controllers/rowsSortable","controllers/undo","controllers/updateFieldOrder"],function(e,t,l,n,o,i,r,a){var s=Marionette.Object.extend({initialize:function(){new t,new e,new l,new n,new o,new i,new r,new a}});return s}),l("controllers/loadContent",["views/rowCollection","controllers/loadControllers","models/rowCollection"],function(e,t,l){var o=Marionette.Object.extend({initialize:function(){this.listenTo(n.channel("app"),"after:loadControllers",this.loadControllers)},loadControllers:function(){new t,n.channel("formContent").request("add:viewFilter",this.getFormContentView,4,this),n.channel("formContent").request("add:saveFilter",this.formContentSave,4,this),n.channel("formContent").request("add:loadFilter",this.formContentLoad,4,this),n.channel("fieldContents").request("add:viewFilter",this.getFormContentView,4,this),n.channel("fieldContents").request("add:saveFilter",this.formContentSave,4,this),n.channel("fieldContents").request("add:loadFilter",this.formContentLoad,4,this)},getFormContentView:function(t){return e},formContentSave:function(e){var t=JSON.parse(JSON.stringify(e));return _.each(t,function(e,l){_.each(e.cells,function(e,n){_.each(e.fields,function(e,o){e.key&&(t[l].cells[n].fields[o]=e.key)})})}),t},formContentLoad:function(e,t,o){if(!0==e instanceof l)return e;var i=n.channel("formContent").request("get:loadFilters"),r="undefined"!=typeof i[1]?!0:!1;t=t||!1,o=o||!1;var a=[];return _.isArray(e)&&0!=e.length&&"undefined"==typeof e[0].cells?_.each(e,function(e,t){a.push({order:t,cells:[{order:0,fields:[e],width:"100"}]})}):a="undefined"==typeof nfLayouts||t||r?e:nfLayouts.rows,new l(a)}});return o});var n=Backbone.Radio;t(["controllers/loadContent"],function(e){var t=Marionette.Application.extend({initialize:function(e){this.listenTo(n.channel("app"),"after:appStart",this.afterNFLoad)},onStart:function(){new e},afterNFLoad:function(e){var t=n.channel("app").request("get:builderEl");jQuery(t).addClass("layouts")}}),l=new t;l.start()}),l("main",function(){})}();
//# sourceMappingURL=almond.build.js.map
//# sourceMappingURL=builder.js.map
