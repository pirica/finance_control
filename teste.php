
<!DOCTYPE html>
<html>
  
<head>
    <title>
        How to hide a div when the user 
        clicks outside of it using jQuery?
    </title>
      
    <style>
        .container {
            height: 200px;
            width: 200px;
            background-color: green;
            border: 5px solid black;
        }
    </style>
      
    <script src=
        "https://code.jquery.com/jquery-3.4.0.min.js">
    </script>
</head>
  
<body>
    <h1 style="color: green">
        GeeksForGeeks
    </h1>
      
    <b>
        How to hide a div when the user clicks
        outside of it using jQuery?
    </b>
      
    <p>Click outside the green div to hide it</p>
      
    <div class="container" style="color:green"></div>
      
    <script type="text/javascript">
        $(document).mouseup(function (e) {
            if ($(e.target).closest(".container").length === 0) {
                $(".container").hide();
            }
        });
    </script>
</body>
  
</html>  