// print function
function printDiv(elem) {
    var URL = window.location.protocol + "//" + window.location.hostname;
    console.log(URL);
    var divToPrint = document.getElementById(elem);
    var newWin = window.open('', 'PRINT', 'height=700,width=900');
    // newWin.document.open();
    newWin.document.write('<html><head><title>' + document.title + '</title>');
    newWin.document.write('<link href="' + URL + '/public/backend/css/invoice.css" rel="stylesheet"" type="text/css" />');
    newWin.document.write('</head>');
    newWin.document.write('<body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    newWin.focus();
    setTimeout(function() { newWin.close(); }, 3000);
}