<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    @include('includes.headTags')
    <style media="screen">
  .noPrint{ display: block; }
  .yesPrint{ display: block !important; }
</style> 
<style media="print">
  .noPrint{ display: none; }
  .yesPrint{ display: block !important; }
</style>
  </head>
  <body>
    <h1>CRM - User</h1>
    <table class="table" cellpadding="2" cellpadding="6">
        <thead>
        <tr>
            <th>No.</th>
            <th>Image</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        </thead>
            <?php $n = 0 ?>
            @foreach($user as $key => $b)
            <?php $n++; ?>
            <tr cellpadding="2" cellspacing="6">
                <td> {{ $n}}</td>
                <td><img src="{{ asset($b->user_image) }}" width="30"></td>
                <td>{{ $b->first_namae }} {{ $b->middle_name }} {{ $b->last_name }}</td>
                <td>{{ $b->user_name }}</td>
                <td>{{ $b->role_name}}</td>
            </tr>
            @endforeach
    </table>
  </body>
  <script>
  window.print();
</script>
</html>