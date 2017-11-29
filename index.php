<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
	<title>
   	ISWA test
   </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       
   <link rel="stylesheet" type="text/css" href="styles.css" >
     
   <script type="text/javascript">
        function updatecombo(t) {
            var y = document.getElementsByName(t.name);
            y.value = t.value;
        }
   </script>
    
   <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {

            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
    </script>

    <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    } 
    </script>
</head>

<body  dir="rtl">
    <?php include_once 'menu.php'; ?>
    
    <h1 style='text-align:center'>أهلا بكم</h1>
    <p>السلام عليكم</p>
</body>

</html>