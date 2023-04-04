<!DOCTYPE html>
<html>

<head>
   <title>Dark Mode Template Example</title>
   <link rel="stylesheet" href="style.css">
   <style>
      body {
         background-color: #fff;
         color: #000;
      }

      .dark-mode{
         background-color: #000;
         color: #fff;
      }

      #wrapper {
         max-width: 600px;
         margin: 0 auto;
         padding: 20px;
      }

      h1 {
         font-size: 36px;
      }

      p {
         font-size: 18px;
      }

      button {
         background-color: #007bff;
         color: #fff;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         cursor: pointer;
         margin-top: 20px;
      }

      .dark-mode button {
         background-color: #fff;
         color: #007bff;
      }
   </style>
</head>

<body>
   <div id="wrapper">
      <h1>Welcome to My Website</h1>
      <p>This is an example of a dark mode template created using jQuery.</p>
      <button id="toggle-theme-btn">Toggle Theme</button>
   </div>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="script.js"></script>

   <script>
      $(document).ready(function() {
         // Set initial theme
         if (localStorage.getItem('theme') === 'dark') {
            $('body').addClass('dark-mode');
         } else {
            $('body').removeClass('dark-mode');
         }

         // Toggle theme when button is clicked
         $('#toggle-theme-btn').on('click', function() {
            $('body').toggleClass('dark-mode');
            if ($('body').hasClass('dark-mode')) {
               localStorage.setItem('theme', 'dark');
            } else {
               localStorage.setItem('theme', 'light');
            }
         });
      });
   </script>
</body>

</html>