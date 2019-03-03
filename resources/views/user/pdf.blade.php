<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style rel="stylesheet">
@media print{
    body {
      color: #000;
      background: #fff;
   }    
   h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;
        text-decoration: underline;
    }
    /*
    .tbl {background-color:#000;}
.tbl td,th,caption{background-color:#fff}
*/

.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
table
{
    table-layout: auto !important;
width: auto !important;
word-wrap: normal;
   max-width: 100% !important
}
table {
	border-collapse: collapse;
	width: 100%;
    border-bottom: 1px solid #CCC;
	}

th {
	padding: 0 0.5em;
	text-align: left;
    border-bottom: 1px solid #CCC;
    font-size: 12pt;
    font-weight: bold;
    margin-bottom: 30px;
	}
tr.yellow td {
	background: #FFC;
	}

td {
    
	
    font-size: 10pt;
    font-weight: normal;
	}

td:first-child {
	width: 190px;
	}

td+td {
	text-align: center;
    font-size: 12pt;
    font-weight: normal;
	}
}
    </style>
  </head>
  <body>
    <h1>CRM - User</h1>
    <table class="table" cellpadding="2" cellpadding="6">
        <thead>
        <tr>
            <th width="50">No.</th>
            <th width="100">Image</th>
            <th width="150">Nama</th>
            <th width="150">Username</th>
            <th width="100">Role</th>
        </tr>
        </thead>
            <?php $n = 0 ?>
            @foreach($user as $key => $b)
            <?php $n++; ?>
            <tr cellpadding="2" cellspacing="6">
                <td width="50"> {{ $n}}</td>
                <td width="100"><img src="{{ asset($b->user_image) }}" width="30"></td>
                <td width="150">{{ $b->first_namae }} {{ $b->middle_name }} {{ $b->last_name }}</td>
                <td width="150">{{ $b->user_name }}</td>
                <td width="100">{{ $b->role_name}}</td>
            </tr>
            @endforeach
    </table>
  </body>
</html>