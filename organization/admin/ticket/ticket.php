
<?php  
require ("phpToPDF.php");
phptopdf_html(' <html> 
   <head> 
   	<style>
* {
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
}

header {
    background-color: #666;
    padding: 30px;
    font-size: 35px;
    color: white;
      }

nav {
    float: left;
    width: 180px;
    height: 100px; /* only for demonstration, should be removed */
    padding: 20px;
}
.layout1{
	float: left;
	width: 180px;
	height: 100px;
	padding: 30px;
}
 
 .travella{

 	 width:800px;
 	 height: 100px;
 	 padding: 20px;
 }
nav ul {
    list-style-type: none;
    padding: 0;
}

article {
    float: left;
    padding: 20px;
    width: 70%;
 
    height: 300px; /* only for demonstration, should be removed */
}
   
   .ticketid {
   	 margin-top:100px;
   	 margin-left: 500px;
   	  padding: 30px;

   }
   .name {
      margin-left:400px;
      padding:30px;
      margin-top:-100px;
   }

   .row:after {
     content: "";
     display: table;
     clerar:both;
   }
   .column{
     float :left;
     padding:20px;

   }

/* Clear floats after the columns */
section:after {
    content: "";
    display: table;
    clear: both;
}

table , tr,td {  width: 450px;
	    border: 1px solid black;
}
   
   </style> 
</head> 
<body> 
<div style="height:400px;border:5px double #ff8000;width:800px;margin-left:20%;margin-top:7%;">
   <section> 
        <nav>   <img src="bus1.jpg" width="150px" height="100px" alt="Italian Trulli">  </nav>  
        <div class="travella"><span style="font-size:30px;color:orange;"> <b> TRAVELLA </b> </span> <img  src="myn2.png" width="30px" height="50px" alt="Italian Trulli"> <br> <i>Tour Bus Service Myanmar </i>  
          &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
          <div class="name"><img src="name.png" width="280px" height="80px" alt="Italian Trulli">  </div> 
           </div>

        
       </section> 

      <div class="row">
        <div class="column">
       <div class="layout1">
       	
       	<table> 
       	  <tr>  
       	       <td> Departure Date </td>
       	       <td> </td> 
       	       </tr>
       	     <tr>  
       	       <td> Departure Time </td>
       	       <td> </td> 
       	       </tr>
       	        
       	       <td> Venue </td>
       	       <td> </td> 
       	       </tr>
       	        <tr>  
       	       <td> Places </td>
       	       <td> </td> 
       	       </tr>
       	        <tr>  
       	       <td> Duration </td>
       	       <td> </td> 
       	       </tr>
       	        <tr>  
       	       <td> Number of people </td>
       	       <td> </td> 
       	       </tr>
       	        <tr>  
       	       <td> Price </td>
       	       <td> </td> 
       	       </tr>
       	       </table>  </div>

<div class="column" style="float:left">
       <h5 style="margin-left:330px;" ,"margin-top:100px;" >Ticket ID    &nbsp; &nbsp;: </h4>
       <h5 style="margin-left:330px;" ,"margin-top:300px;" >Name  &nbsp; &nbsp; &nbsp;  &nbsp; :</h4>
       <h5 style="margin-left:329px;" ,"margin-top:300px;" >Date  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; :  </h4>
     </div>
  </div> 
  </section>   
</div>
</body> </html> ','', 'ticket.pdf');
/*$my_html = '<html>
    <p> convert php to pdf plz download</p>
</html>';
*/
$folder = '../phpToPDF/pdfs';
$filename = 'ticketpdf.pdf';

$pdf_options = array(
     "source_type"=> 'html',
     "source"=>$my_html,
    "action"=>'save',
    "save_directory"=>$folder,
    "file_name"=>$filename
);

   phptopdf($pdf_options);
   
   echo"<a href='" . $folder . "/" . $filename . "'> Download your pdf </a>";
   echo "<hr>";
  // echo "<textarea style='width:800px;height:400px; font-size:larger;'disabled>".$my_html."</textarea>";
 //  echo ("<a href='php_from_html.pdf'>Download Your PDF</a>");;
 echo("hello");
   ?>


