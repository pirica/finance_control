<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>How To Create Dark And Light Mode Website Using jQuery - Techsolutionstuff</title>        
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style> 
        body{         
        text-align:center; 
        } 
        img{ 
            height:140px; 
            width:140px;  
        } 
        h1{ 
        color: #000; 
        margin-top: 50px;
        } 
        .mode { 
            float:right; 
            margin-top: 20px;
            margin-right: 20px;
        } 
        .change { 
            cursor: pointer; 
            border: 1px solid #555; 
            border-radius: 10%; 
            width: 20px; 
            text-align: center; 
            padding: 8px; 
            margin-left: 8px; 
        } 
        .dark{ 
            background-color: #222; 
            color: #e6e6e6; 
        }
      .dark h1{ 
        color: #fff;         
        } 
    </style> 
</head>   
<body> 
    <div class="mode"> 
        <b>Select Mode:</b><span class="change">OFF</span> 
    </div><br>     
    <div> 
      <h1><i>Techsolutionstuff</i></h1> 
        <p><i>We Give Best Tech Stuff for You</i></p> 
        <h3>Light Mode and Dark Mode</h3>                    
        <p> 
            Click on the switch on <b>Top Right Corner</b>
            to move to <b>Dark Mode</b> and <b>Light Mode.</b>
        </p> 
    </div>       
    <script> 
        $( ".change" ).on("click", function() { 
            if( $( "body" ).hasClass( "dark" )) { 
                $( "body" ).removeClass( "dark" ); 
                $( ".change" ).text( "OFF" ); 
            } else { 
                $( "body" ).addClass( "dark" ); 
                $( ".change" ).text( "ON" ); 
            } 
        }); 
    </script> 
</body>   
</html>