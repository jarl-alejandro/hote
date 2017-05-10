'use strict'

var Paginator = function (tableName, navigation, items) {
  this.table = document.querySelector(tableName)
  this.nav = document.querySelector(navigation)
  this.items = items
  this.pages = 0
  this.currentPage = 1
}

Paginator.prototype.init = function () {
  var rows = this.table.rows;
  var records = (rows.length - 1);
  this.pages = Math.ceil(records / this.items);
  this.inited = true;
}

Paginator.prototype.showNavigation = function (objecto) {

  var li = `<li class="prev"><a href="#!">
    <i class="material-icons">chevron_left</i></a>
  </li>`
  
  for (var page = 1; page <= this.pages; page++){
    li += `<li id="pg${page}" class="waves-effect pagin-boton" style="cursor:pointer" data-id="${page}"><a>${page}</a></li>`
  }

  li += `<li class="next"><a href="#!">
  <i class="material-icons">chevron_right</i></a>
  </li>`

  this.nav.innerHTML = li;
}

Paginator.prototype.showTable = function (from, to) {
  var rows = this.table.rows;

  for (var i = 1; i < rows.length; i++) {
    if (i < from || i > to)
      rows[i].style.display = 'none';
    else
      rows[i].style.display = '';
  }
}

Paginator.prototype.showPage = function (pageNumber) {
  var oldPageAnchor = document.getElementById('pg'+this.currentPage)
  oldPageAnchor.className = "waves-effect pagin-boton"

  this.currentPage = pageNumber
  var newPageAnchor = document.getElementById('pg'+this.currentPage)
  newPageAnchor.className = 'waves-effect pagin-boton active'

  var from = (pageNumber - 1) * this.items + 1
  var to = from + this.items - 1
  this.showTable(from, to)
}

Paginator.prototype.prev = function () {
  if (this.currentPage > 1)
    this.showPage(this.currentPage - 1);
}

Paginator.prototype.next = function () {
  if (this.currentPage < this.pages) {
    this.showPage(this.currentPage + 1);
  }
}