<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        th { 
            color: #fff;
        }
    </style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    th{ 
        color:#fff;
            }
</style>
<section>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand">Ballers Hub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <a href="land.html" class="btn btn-outline-light">Home</a>
            </section>

<table class="table table-striped">
    <tr  class="bg-info">
        <th  data-colname="position" data-order="desc">Position &#9650</th>
        <th  class="bg-info" data-colname="name" data-order="desc">Name &#9650</th>
        <th  data-colname="points" data-order="desc">Points &#9650</th>
        <th  data-colname="assists" data-order="desc">Assists &#9650</th>
        <th  data-colname="rebounds" data-order="desc">Rebounds &#9650</th>
        <th  data-colname="steals" data-order="desc">Steals &#9650</th>
    </tr>
    <tbody id="myTable">
        
    </tbody>
</table>

<script>
    var img = document.createElement('img'); 
    var myArray = [
    {'position':'PointGuard','name':'Jandrix', 'points':'30', 'assists':'8','rebounds':'2','steals':'0',},
    {'position':'Center','name':'Uchie', 'points':'32', 'assists':'7','rebounds':'3','steals':'2',},
    {'position':'ShootingForward','name':'Ashraf', 'points':'29', 'assists':'6','rebounds':'5','steals':'0',},
    {'position':'ShootingGuard','name':'Donnor', 'points':'25', 'assists':'2','rebounds':'8','steals':'1',},
    {'position':'Center','name':'Mike', 'points':'27', 'assists':'3','rebounds':'7','steals':'4',},
    {'position':'PowerForward','name':'Khadaffe', 'points':'24', 'assists':'1','rebounds':'12','steals':'8',},
    ]

    $('th').on('click', function(){
    var column = $(this).data('colname'); // Use 'data-colname' instead of 'data-column'
    var order = $(this).data('order');
    var text = $(this).html();
    text = text.substring(0, text.length - 1);

    if (order == 'desc') {
        $(this).data('order', 'asc');
        var tempArray = myArray.slice(); // Create a copy of the array
        tempArray.sort((a, b) => (a[column] > b[column]) ? 1 : -1);
        buildTable(tempArray);
    } else {
        $(this).data('order', 'desc');
        var tempArray = myArray.slice(); // Create a copy of the array
        tempArray.sort((a, b) => (a[column] < b[column]) ? 1 : -1);
        buildTable(tempArray);
    }

    text += (order == 'desc') ? '▼' : '▲';
    $(this).html(text);
});

function buildTable(data) {
    var table = document.getElementById('myTable');
    table.innerHTML = ''; // Clear the table content before building again

    for (var i = 0; i < data.length; i++) {
        var row = `<tr>
            <td>${data[i].position}</td>
            <td>${data[i].name}</td>
            <td>${data[i].points}</td>
            <td>${data[i].assists}</td>
            <td>${data[i].rebounds}</td>
            <td>${data[i].steals}</td>
        </tr>`;
        table.innerHTML += row;
    }
}

buildTable(myArray);
</script>
</body>
</html>