/**
 * New order JS
 *
 * Add dynamically fields in new order. Each row is identified by id in <tr id="rowXX"> selector where XX is
 * numRow value.
 */

/**
 * The numRow value is our "counter" which is used to identify rows. To avoid duplication rows this value can
 * only increase
 */
let numRow = 1;

/**
 * This is table element where new fields will be add
 */
let table = document.getElementById("newOrderBody");

let itemName = document.getElementById("itemName").innerHTML;
let quantity = document.getElementById("quantity").innerHTML;
let units = document.getElementById("units").innerHTML;
let price = document.getElementById("price").innerHTML;
let buildings = document.getElementById("buildings").innerHTML;
let contractors = document.getElementById("contractors").innerHTML;


/**
 * Insert new row between selector given from table value
 */
function addRow()
{
    let html = '';
    numRow++;
    html = '<tr id="newOrderRow' + numRow +'">';
    html += '<td>' + itemName + '</td>';
    html += '<td>' + quantity + '</td>';
    html += '<td>' + units + '</td>';
    html += '<td>' + price + '</td>';
    html += '<td>' + buildings + '</td>';
    html += '<td>' + contractors + '</td>';
    html += '<td><button class="btn btn-danger btn-sm" onclick="removeRow(' + numRow + ')"><i class="fas fa-times"></i></button></td>';
    html += '</tr>';
    table.insertAdjacentHTML('beforeend', html);
}

function removeRow(rowId)
{
    let idElement = 'newOrderRow' + rowId.toString();
    e = document.getElementById(idElement);
    e.remove();
}
