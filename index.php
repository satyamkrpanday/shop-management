<?php
session_start();

if($_SESSION["sess_user"]) {
  $loggedInUser = $_SESSION["sess_user"];
  }else header("Location: login.php");
?>
<html>
 <head>
 <link rel="stylesheet" href="css/home.css">

 <title>Shop Management</title>
    <link
      rel="stylesheet"
      href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"
    />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="javascript/generateBill.js"></script>
 </head>
 <body>

 <button class="tablink" id="defaultOpen" onclick="openPage('Home', this, 'red')">Home</button>
 <button class="tablink" onclick="openPage('AddProduct', this, 'green')">Add Product</button>
<button class="tablink" onclick="openPage('GenerateBill', this, 'blue')">Generate Bill</button>
<button class="tablink" onclick="openPage('Contact', this, 'orange')">Contact</button>
<button class="tablink" onclick= "location.href='logout.php'" style="color:red">Logout</button>
<div id="Home" class="tabcontent">

 <center> <h3>Hi, Welcome To Billing Portal Of Our Shop</h3></center>
 <center> <img src="/images/home_1.jpeg" style="width:75%; height: 85%;">  </center>
</div>
<div id="AddProduct" class="tabcontent">

    <div class="col-sm-6 col-sm-offset-3">
      <h1>Add product to stock</h1>

      <form action="phpFiles/addProduct.php" method="POST" target="resultFrame">
        <div id="name-group" class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            placeholder="Product Name"
          />
        </div>

        <div id="price" class="form-group">
          <label for="price">Price</label>
          <input
            type="text"
            class="form-control"
            id="price"
            name="price"
            placeholder="Price in INR"
          />
        </div>

        <div id="code" class="form-group">
          <label for="code">Product code</label>
          <input
            type="text"
            class="form-control"
            id="code"
            name="code"
            placeholder="Product code to make search easier"
          />
        </div>

        <div id="quantity" class="form-group">
          <label for="quantity">Quantity</label>
          <input
            type="text"
            class="form-control"
            id="quantity"
            name="quantity"
            placeholder="Quantity in Kg for solid, Ltr for liquid and Quantity in numbers"
          />
        </div>

        <button type="submit" name="save" class="btn btn-success">
          Add 
        </button>
      </form>

      <iframe name="resultFrame">
</iframe>
    </div>
</div>

<div id="GenerateBill" class="tabcontent">
<style>
*
{
	border: 0;
	/* box-sizing: content-box; */
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
  /* background: inherit; */
	text-decoration: none;
	vertical-align: top;
}

#GenerateBill
{
  background: #0000ff;
}
/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

/* *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; } */

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #0000ff; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; }
html {  cursor: default; }

/* body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; } */
body { background: #0000ff; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #FFF; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 1.25em 0.5em;	
	float: right;
	text-align: center;
	width: 2em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -3.5em 0 0; }

/* .add:hover { background: #00ADEE; } */
/* 
.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; } */

/* tr:hover .cut { opacity: 1; } */

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }

  .noprint{
       display:none;
   }
}
 .appProdbutton {
  background-color:inherit;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.buttonBlack {
  background-color: white;
  color: black;
  border: 2px solid #555555;
} 

@page { margin: 0; }
    </style>
		<header>
    
			<h1>Invoice</h1>
      <p> Shop details </p>
			<address>
				<p>Super market</p>
				<p>Maldahiya<br>Varanasi - UP 221002</p>
				<p>+91 9169950965</p>
			</address>
			
		</header>
		<article>
     <p> Customer name and phone number </p>
      <address contenteditable>
				<p>Shivam Pandey</p>
				<p>+91 9169950965</p>
			</address>

<iframe name="validateResultFrame">
</iframe> 

<form id="appendProduct" class="noprint">
            <input type="text" id="productName" placeholder="Search by product name or code" style="color:black"/><br>
            <input type="submit" value="Validate and Add" />
        </form>
        
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#appendProduct').on('submit', function(e){
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
                    var productName = $('#productName').val();
                    $.ajax({
                        type: "POST",
                        url: 'phpFiles/product.php',
                        data: {productName: productName},
                        success: function(data){
                            if (data === "Product not found") {
                              alert(data);
                              return;
                            }
                            data = JSON.parse(data);
                           
                            var row = document.createElement('tr');

                            row.innerHTML = '<td><a class="cut">-</a><span>' + data[0].NAME +'</span></td>' +
                              '<td><span contenteditable>' + data[0].code  +'</span></td>' +
                              '<td><span data-prefix>INR</span><span contenteditable>' + data[0].price + '</span></td>' +
                              '<td><span contenteditable>' + data[0].quantity +'</span></td>' +
                              '<td><span data-prefix>INR </span><span>0.00</span></td>';
                             document.querySelector('table.inventory tbody').appendChild(row);
                        }
                    });
                });
            });
        </script>
			<table class="meta">
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><span contenteditable>
<script> document.write(new Date().toLocaleDateString()); </script>
</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Due</span></th>
					<td><span id="prefix" contenteditable>INR </span><span>0.00</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Item</span></th>
						<th><span contenteditable>Description</span></th>
						<th><span contenteditable>Rate</span></th>
						<th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th>
					</tr>
				</thead>
				<tbody>
    
					<tr>
           <td>

              
              <a class="cut">-</a><span contenteditable>Paper bag</span></td>
						<td><span contenteditable> Paper bag to carry items</span></td>
						<td><span data-prefix>INR</span><span contenteditable>15.00</span></td>
						<td><span contenteditable>1</span></td>
						<td><span data-prefix>INR</span><span>60.00</span></td>
					</tr>

				</tbody>
			</table>
			<a class="add"> + </a>
			<table class="balance">
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>INR</span><span>15.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Paid</span></th>
					<td><span data-prefix>INR</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Balance Due</span></th>
					<td><span data-prefix>INR</span><span>15.00</span></td>
				</tr>
			</table>
            
		</article>
    <style>
      <style>
.button {
  background-color: black;
  border: none;
  color: orange;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 20px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.buttonprint:hover {
  background-color: #555555;
  color: black;
}
</style>
    <center><button class="button buttonprint noprint" onclick="printDiv('GenerateBill')" style="color:black"> Generate Bill </button></center>
</div>

<div id="Contact" class="tabcontent" style="background-color:orange;">

  <style>
    * {
  box-sizing: border-box;
}

/* Style inputs */
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  margin-top: 0px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: black;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

/* Style the container/contact section */
.container {
  border-radius: 5px;
  background-color: 'orange';
  padding: 10px;
}

/* Create two columns that float next to eachother */
.column {
  float: left;
  width: 50%;
  margin-top: 6px;
  padding: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column, input[type=submit] {
    width: 50%;
    margin-top: 0;
  }
}
    </style>
  <div style="text-align:center">
    <h2>Contact Us</h2>
  </div>
  <div class="row">
    <div class="column">
      <img src="/images/myShopLocation.png" style="width:100%">
    </div>
    <div class="column">
      <form action="phpFiles/contactus.php" method="POST" target="contactFrame">
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" placeholder="Your name..">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastName" placeholder="Your last name..">
        <label for="country">Country</label>
        <select id="country" name="country" style="color:black">
          <option value="india">India</option>
          <option value="nepal">Nepal</option>
          <option value="usa">USA</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" style="color:black" placeholder="Write something..">Print</textarea>
        <input type="submit" name="save" value="Submit">
      </form>

      
      <iframe name="contactFrame">
</iframe>
    </div>
  </div>
</div>
<script src="javascript/home.js"></script>
 </body>
</html>
