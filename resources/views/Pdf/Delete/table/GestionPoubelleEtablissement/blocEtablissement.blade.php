<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .date{
                margin:-20px 0 0 75%  ;
            }
            .img-container{
                border-radius: 20px;
                border:2px rgb(198, 106, 210) dashed;
                width: 180px;
                height: 180px;
                margin-left: 20px;
            }
            .page{
                padding:20px;
            }
            table{
                border:1px solid;
                margin: 0 auto;
            }
             td , th{
                border:1px solid;
                font-size:14px;
                padding:10px;
                text-align: left;
            }
        </style>
    </head>
    <body class="page">
        <img class="img-logo" src="{{ public_path('images/logo.png') }}" alt="logo" width="50px" height="50px"/>
        <p class='date'>{{ date('d-m-Y H:i:s') }}</p>
        <hr/>
        <br/>
        <h2 style="text-align: center;">Liste blocs eteblissements : </h2>        <br/>
        <table>
            <tr>
                <th>Id:</th>
                <th>Nom etblissement:</th>
                <th style="color: red">Nom bloc etblissement:</th>
                <th>Etage:</th>
                <th>Date de création:</th>
                <th>Date de dernier modification: </th>
                <th style='background-color:red; color:white;'>Date de suppression</th>
            </tr>
            @foreach ($data as $l)
            <tr>
                <td> {{ $l['id'] }}</td>
                <td>{{ $l['etablissement'] }}</td>
                <td style="color: red">{{ $l['nom_bloc_etablissement'] }}</td>
                <td>
                   @foreach($l['etage_etablissements'] as $etage)
                   Etage: {{ $etage->nom_etage_etablissement }}<br/>
                   @endforeach
                </td>
                <td>{{ $l['created_at'] }}</td>
                <td>{{ $l['updated_at'] }}</td>
                <td style='color:red; font-weight:bold;'> {{ $l['deleted_at'] }}</td>
            </tr>
            @endforeach
        </table>

    </body>
</html>
