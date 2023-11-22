<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link href='http://fonts.googleapis.com/css?family=Paprika|Merienda+One|Courgette' rel='stylesheet' type='text/css'>
		<script src="js/modernizr.custom.63321.js"></script>

		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				background: #fff url(fondo.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #AA6333;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
			/* Demo 3 */

/* GLOBALS */

*,
*:after,
*:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}
.form-3 {
    font-family: 'Ubuntu', 'Lato', sans-serif;
    font-weight: 800;
    /* Size and position */
    width: 300px;
    position: relative;
    margin: 160px auto 30px;
    padding: 10px;
    overflow: hidden;

    /* Styles color del cuadro de pass*/
    background: #920F5A; 
    border-radius: 0.4em;
    border: 1px solid #9F1A65;
    box-shadow: 
        inset 0 0 2px 1px rgba(255,255,255,0.08), 
        0 16px 10px -8px rgba(0, 0, 0, 0.6);
}

.form-3 label {
    /* Size and position */
    width: 80%;
    float: left;
    padding-top: 9px;

    /* Styles */
    color: #ddd;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 0 1px 0 #000;
    text-indent: 10px;
    font-weight: 700;
    cursor: pointer;
}

.form-3 input[type=text],
.form-3 input[type=password] {
    /* Size and position */
    width: 100%;
    float: left;
    padding: 8px 5px;
    margin-bottom: 10px;
    font-size: 18px;

    /* Styles */
    background: #3E0C89; /* Fallback */
    background: -moz-linear-gradient(#3E0C89, #3E0C89);
    background: -ms-linear-gradient(#3E0C89, #27292c);
    background: -o-linear-gradient(#3E0C89, #27292c);
    background: -webkit-gradient(linear, 0 0, 0 100%, from(#211F24), to(#27292c));
    background: -webkit-linear-gradient(#3E0C89, #27292c);
    background: linear-gradient(#3E0C89, #27292c);    
    border: 1px solid #000;
    box-shadow:
        0 1px 0 rgba(255,255,255,0.1);
    border-radius: 3px;

    /* Font styles */
    font-family: 'Ubuntu', 'Lato', sans-serif;
    color: #fff;

}

.form-3 input[type=text]:hover,
.form-3 input[type=password]:hover,
.form-3 label:hover ~ input[type=text],
.form-3 label:hover ~ input[type=password] {
    background: #27292c;
}

.form-3 input[type=text]:focus, 
.form-3 input[type=password]:focus {
    box-shadow: inset 0 0 2px #000;
    background: #211F24;
    border-color: #51cbee;
    outline: none; /* Remove Chrome outline */
}

.form-3 p:nth-child(3),
.form-3 p:nth-child(4) {
    float: left;
    width: 50%;
}

.form-3 label[for=remember] {
    width: auto;
    float: none;
    display: inline-block;
    text-transform: capitalize;
    font-size: 11px;
    font-weight: 400;
    letter-spacing: 0px;
    text-indent: 2px;
}

.form-3 input[type=checkbox] {
    margin-left: 10px;
    vertical-align: middle;
}

.form-3 input[type=submit] {
    /* Width and position */
    width: 100%;
    padding: 8px 5px;
  
    /* Styles */
    border: 1px solid #4D0DAD; /* Fallback */
    border: 1px solid rgba(0,0,0,0.4);
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,0.3),
        inset 0 10px 10px rgba(255,255,255,0.1);
    border-radius: 3px;
    background: #4D0DAD;
    cursor:pointer;
  
    /* Font styles */
    font-family: 'Ubuntu', 'Lato', sans-serif;
    color: white;
    font-weight: 700;
    font-size: 15px;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.8);
}

.form-3 input[type=submit]:hover { 
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
}

.form-3 input[type=submit]:active { 
    background: #287db5;
    box-shadow: inset 0 0 3px rgba(0,0,0,0.6);
    border-color: #000; /* Fallback */
    border-color: rgba(0,0,0,0.9);
}

.no-boxshadow .form-3 input[type=submit]:hover {
    background: #2a92d8;
}

.form-3:after {
    /* Size and position */
    content: "";
    height: 1px;
    width: 33%;
    position: absolute;
    left: 20%;
    top: 0;

    /* Styles */
    background: -moz-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
    background: -ms-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
    background: -o-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
    background: -webkit-gradient(linear, 0 0, 100% 0, from(transparent), color-stop(0.25, #444), color-stop(0.5, #b6b6b8), color-stop(0.75, #444), to(transparent));
    background: -webkit-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
    background: linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
}

.form-3:before {
    /* Size and position */
    content: "";
    width: 8px;
    height: 5px;
    position: absolute;
    left: 34%;
    top: -7px;
    
    /* Styles */
    border-radius: 50%;
    box-shadow: 0 0 6px 4px #fff;
}

.form-3 p:nth-child(1):before{
    /* Size and position */
    content:"";
    width:250px;
    height:100px;
    position:absolute;
    top:0;
    left:45px;

    /* Styles */
    -webkit-transform: rotate(75deg);
    -moz-transform: rotate(75deg);
    -ms-transform: rotate(75deg);
    -o-transform: rotate(75deg);
    transform: rotate(75deg);
    background: -moz-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
    background: -ms-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
    background: -o-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
    background: -webkit-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
    background: linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
    pointer-events:none;
}

.no-pointerevents .form-3 p:nth-child(1):before {
    display: none;
}

        h2 { 
        font-family: 'Merienda One', cursive;
        font-weight: 400;
        font-size: 100px;
        text-shadow: 0px 10px #E1E1E1;
         }
		</style>
    </head>
    <body style="background-image: url(fondo.jpg),url(img/pattern.png);">
        

        <br>
        <br>
        <br>
<center>
    <h2>
        <font color='#AA6333'>
            Picking
        </font>
    </h2>
</center>

        <div class="container">

			
			<section class="main">
				<form class="form-3" action='procesa_login.php' method='POST'>
				   
				    <p class="clearfix">
				        <label for="password">Codigo de identificacion</label>
				        <input type="password" name="pass" id="password" placeholder="Password" autofocus> 
				    </p>
				    <p class="clearfix">
				        <input type="submit" name="submit" value="INICIAR">
				    </p>       
				</form>
			</section>
			
        </div>
    </body>
</html>