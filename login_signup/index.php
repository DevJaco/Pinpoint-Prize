<!DOCTYPE html>
<html >
  
  <head>
    <meta charset="UTF-8">
    <title>Login/Sign-Up</title>
    
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/jquery.image_scroll.min.js"></script>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
  
  </head>
  <body>

    <div class = "container">
     <section>
    	<!--  Image scroller !-->
    		  <header>
    	    	<nav class="fixed">
    	    	
    	    	 <ul>
    	    		<li><a id="modal_trigger" href="#modal">Log In</a></li>
					<!-- <li><a href="#">About</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Team</a></li>
					<li><a href="#">Contact</a></li>
					!-->
				      </ul>
    	    	</nav>
    	   </header>
     

    	   <div id="scroller">
    	   

    	    	<div class = "space active"></div>
    	    	<div class = "e1"></div>
    	    	<div class = "e2"></div>
    	    	
    	   </div>
      </section>
	 <!-- Popup overlay !-->
	 <section>
<footer>

  <div class="footer-message">

    <ul>
          <li><a href="#">About</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Team</a></li>
          <li><a href="#">Contact</a></li>
    </ul>
    
    <p>2015 Pinpoint Prize
      <br>

          <a href="#">Terms & Conditions</a>
          <a href="#">Private Policy</a>
          <a href="#">Fees & Charges</a>

    </p>
    
    
  </div>

</footer>

</section>
		<div id="modal" class="popupContainer" style="display:none;">
  <section class="popupBody">
    <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
        <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle" id="heading_signup">Enter your personal details <strong>to create an acount</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" method="GET" action="#" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="username" placeholder="Email" type="text" size="50" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" name = "password" maxlength="255" id="password" placeholder="Password" type="password" size="50" />
              </div>
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">Repeat password *</label>
                <input class="string optional" name = "repeat_pass" maxlength="255" id="repeat_pass" placeholder="Repeat password" type="password" size="50" />
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="submit" type="submit" value="Create Account" />
              <span class="simform__actions-sidetext">By creating an account you agree to our <a class="special_term" href="#" target="_blank" role="link">Terms & Privacy</a></span>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Create an account with <strong>Facebook</strong></span>
              </div>
            </a>
              
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>Create an account with <strong>Google+</strong></span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle" id="heading_login"> 
				Enter your email and password<strong> to sign in</strong>        
		  </span>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" method="GET" action="#" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" id="login_username_lbl" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="login_username" placeholder="Email" type="text" name = "username" size="50" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="password" name = "password" size="50" />
                						<span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" type="submit" name = "submit" value="Log In" />
              <span class="simform__actions-sidetext"><a class="special" role="link" href="#">Forgot your password?<br>Click here</a></span>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Facebook</strong></span>
              </div>
            </a>
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Google+</strong></span>
              </div>
            </a>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
  </div>

    <script src="js/index.js"></script>

    <script type="text/javascript">
  		$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".logmod__close" });
  </script>    
    </section>
    </div>
  	</div>