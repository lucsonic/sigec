/*! RowsGroup for DataTables v2.0.0
 * 2015-2016 Alexey Shildyakov ashl1future@gmail.com
 * 2016 Tibor Wekerle
 */

/**
 * @summary     RowsGroup
 * @description Group rows by specified columns
 * @version     2.0.0
 * @file        dataTables.rowsGroup.js
 * @author      Alexey Shildyakov (ashl1future@gmail.com)
 * @contact     ashl1future@gmail.com
 * @copyright   Alexey Shildyakov
 * 
 * License      MIT - http://datatables.net/license/mit
 *
 * This feature plug-in for DataTables automatically merges columns cells
 * based on it's values equality. It supports multi-column row grouping
 * in according to the requested order with dependency from each previous 
 * requested columns. Now it supports ordering and searching. 
 * Please see the example.html for details.
 * 
 * Rows grouping in DataTables can be enabled by using any one of the following
 * options:
 *
 * * Setting the `rowsGroup` parameter in the DataTables initialisation
 *   to array which containes columns selectors
 *   (https://datatables.net/reference/type/column-selector) used for grouping. i.e.
 *    rowsGroup = [1, 'columnName:name', ]
 * * Setting the `rowsGroup` parameter in the DataTables defaults
 *   (thus causing all tables to have this feature) - i.e.
 *   `$.fn.dataTable.defaults.RowsGroup = [0]`.
 * * Creating a new instance: `new $.fn.dataTable.RowsGroup( table, columnsForGrouping );`
 *   where `table` is a DataTable's API instance and `columnsForGrouping` is the array
 *   described above.
 *
 * For more detailed information please see:
 *     
 */
!function(e){ShowedDataSelectorModifier={order:"current",page:"current",search:"applied"},GroupedColumnsOrderDir="asc";var r=function(e,r){this.table=e.table(),this.columnsForGrouping=r,this.orderOverrideNow=!1,this.mergeCellsNeeded=!1,this.order=[];var t=this;e.on("order.dt",function(e,r){t.orderOverrideNow?t.orderOverrideNow=!1:(t.orderOverrideNow=!0,t._updateOrderAndDraw())}),e.on("preDraw.dt",function(e,r){t.mergeCellsNeeded&&(t.mergeCellsNeeded=!1,t._mergeCells())}),e.on("column-visibility.dt",function(e,r){t.mergeCellsNeeded=!0}),e.on("search.dt",function(e,r){t.mergeCellsNeeded=!0}),e.on("page.dt",function(e,r){t.mergeCellsNeeded=!0}),e.on("length.dt",function(e,r){t.mergeCellsNeeded=!0}),e.on("xhr.dt",function(e,r){t.mergeCellsNeeded=!0}),this._updateOrderAndDraw()};r.prototype={setMergeCells:function(){this.mergeCellsNeeded=!0},mergeCells:function(){this.setMergeCells(),this.table.draw()},_getOrderWithGroupColumns:function(e,r){void 0===r&&(r=GroupedColumnsOrderDir);var t=this,n=this.columnsForGrouping.map(function(e){return t.table.column(e).index()}),o=e.filter(function(e){return n.indexOf(e[0])>=0}),i=e.filter(function(e){return n.indexOf(e[0])<0}),d=o.map(function(e){return e[0]}),s=n.map(function(e){var t=d.indexOf(e);return t>=0?[e,o[t][1]]:[e,r]});return s.push.apply(s,i),s},_getInjectedMonoSelectWorkaround:function(e){if(1===e.length){var r=e[0][0],t=this.order.map(function(e){return e[0]}).indexOf(r);if(t>=0)return[[r,this._toogleDirection(this.order[t][1])]]}return e},_mergeCells:function(){var e=this.table.columns(this.columnsForGrouping,ShowedDataSelectorModifier).indexes().toArray(),r=this.table.rows(ShowedDataSelectorModifier)[0].length;this._mergeColumn(0,r-1,e)},_mergeColumn:function(r,t,n){var o=n.slice();currentColumn=o.shift(),currentColumn=this.table.column(currentColumn,ShowedDataSelectorModifier);var i,d=currentColumn.nodes(),s=currentColumn.data(),u=r;for(i=r+1;i<=t;++i)s[i]===s[u]?e(d[i]).hide():(e(d[u]).show(),e(d[u]).attr("rowspan",i-1-u+1),o.length>0&&this._mergeColumn(u,i-1,o),u=i);e(d[u]).show(),e(d[u]).attr("rowspan",i-1-u+1),o.length>0&&this._mergeColumn(u,i-1,o)},_toogleDirection:function(e){return"asc"==e?"desc":"asc"},_updateOrderAndDraw:function(){this.mergeCellsNeeded=!0;var r=this.table.order();r=this._getInjectedMonoSelectWorkaround(r),this.order=this._getOrderWithGroupColumns(r),this.table.order(e.extend(!0,Array(),this.order)),this.table.draw()}},e.fn.dataTable.RowsGroup=r,e.fn.DataTable.RowsGroup=r,e(document).on("init.dt",function(t,n){if("dt"===t.namespace){var o=new e.fn.dataTable.Api(n);if(n.oInit.rowsGroup||e.fn.dataTable.defaults.rowsGroup){options=n.oInit.rowsGroup?n.oInit.rowsGroup:e.fn.dataTable.defaults.rowsGroup;var i=new r(o,options);e.fn.dataTable.Api.register("rowsgroup.update()",function(){return i.mergeCells(),this}),e.fn.dataTable.Api.register("rowsgroup.updateNextDraw()",function(){return i.setMergeCells(),this})}}})}(jQuery);
