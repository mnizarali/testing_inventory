<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="loginForm col-lg-5 col-md-8 col-sm-8 p-4">
      <div class="loginHeader pt-3 pb-4">
        <h4>Register</h4>
        <p>Register to access Kasir App!</p>
      </div>
      <form method="POST" action="{{ route('dashboard.user.create') }}">  <div class="loginBody">
        @csrf
          <div class="form-group">
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-lg" name="name" placeholder="Name...">
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg" name="email" placeholder="Email...">
          </div>
          <div class="form-group">
            <div class="input-group mb-3">
              <input type="password" class="form-control form-control-lg" name="password" placeholder="Password...">
            </div>
          </div>
          <div class="form-group">
            <select name="role" class="input-group mb-3 border">
             <option value="employee" selected>Employee </option>
             <option value="admin">Admin</option>
            </select>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-lg btn-primary">Register</button> </div>
        </div>
      </form>  </div>
  </div>
</body>
</html>
