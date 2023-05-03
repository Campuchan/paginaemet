<!-- index.php -->
<html>
<head>
  <title>PHP AJAX Example</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#form").submit(function(event){
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "procesador.php",
          data: $(this).serialize(),
          success: function(response){
            $("#resultado").html(response);
          }
        });
      });
    });
  </script>
</head>
<body>
  <form id="form">
    <label for="nombre">nombre</label>
    <input type="text" name="nombre">
    <label for="email">email</label>
    <input type="email" name="email">
    <input type="submit" value="Enviar">
  </form>
  <div id="resultado"></div>
</body>
</html>
