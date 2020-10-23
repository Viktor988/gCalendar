
 <html>
 <head>
 <link rel="stylesheet" type="text/css" href="{{ asset('css/RVerify.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}"/>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
 </head>
 <body>
 <form {{route('kor.store')}}  method="post" name="form" id="form" onSubmit="return Provera()">
 {{ csrf_field() }}
 <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

  </div>
    <div class="form-group">

    <input type="text" class="form-control" id="emailtest" name="emailtest"   aria-describedby="emailHelp" placeholder="Enter email">

  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <input type="date" class="form-control" name="date" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Time</label>
    <input type="time" class="form-control" name="time" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

  @if(!isset($_SESSION['access_token']))
  <a href="{{ route('oauthCallback') }}">Log on Email</a><p>email:posaokalendarphp@gmail.com,pass:posaokalendar1</p>
  @endif
  <div id="error"></div>

 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
</form>

<script
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="{{ asset('js/main.js')}}" type="text/javascript"></script>
   <script src="{{ asset('js/RVerify.min.js')}}" type="text/javascript"></script>
 </body>

 </html>
