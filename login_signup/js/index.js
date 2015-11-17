var LoginModalController = {
    tabsElementName: ".logmod__tabs li",
    tabElementName: ".logmod__tab",
    inputElementsName: ".logmod__form .input",
    hidePasswordName: ".hide-password",
    
    inputElements: null,
    tabsElement: null,
    tabElement: null,
    hidePassword: null,
    
    activeTab: null,
    tabSelection: 0, // 0 - first, 1 - second
        
    
    findElements: function () {
        var base = this;
        
        base.tabsElement = $(base.tabsElementName);
        base.tabElement = $(base.tabElementName);
        base.inputElements = $(base.inputElementsName);
        base.hidePassword = $(base.hidePasswordName);
        
        return base;
    },
    
    setState: function (state) {
    	var base = this,
            elem = null;
        
        if (!state) {
            state = 0;
        }
        
        if (base.tabsElement) {
        	elem = $(base.tabsElement[state]);
            elem.addClass("current");
            $("." + elem.attr("data-tabtar")).addClass("show");
        }
  
        return base;
    },
    
    getActiveTab: function () {
        var base = this;
        
        base.tabsElement.each(function (i, el) {
           if ($(el).hasClass("current")) {
               base.activeTab = $(el);
           }
        });
        
        return base;
    },
   
    addClickEvents: function () {
    	var base = this;
        
        base.hidePassword.on("click", function (e) {
            var $this = $(this),
                $pwInput = $this.prev("input");
            
            if ($pwInput.attr("type") == "password") {
                $pwInput.attr("type", "text");
                $this.text("Hide");
            } else {
                $pwInput.attr("type", "password");
                $this.text("Show");
            }
        });
 
        base.tabsElement.on("click", function (e) {
            var targetTab = $(this).attr("data-tabtar");
            
            e.preventDefault();
            base.activeTab.removeClass("current");
            base.activeTab = $(this);
            base.activeTab.addClass("current");
            
            base.tabElement.each(function (i, el) {
                el = $(el);
                el.removeClass("show");
                if (el.hasClass(targetTab)) {
                    el.addClass("show");
                }
            });
        });
        
        base.inputElements.find("label").on("click", function (e) {
           var $this = $(this),
               $input = $this.next("input");
            
            $input.focus();
        });
        
        return base;
    },
    
    initialize: function () {
        var base = this;
        
        base.findElements().setState().getActiveTab().addClickEvents();
    }
};


$(document).ready(function() {
    LoginModalController.initialize();
    
    $(document).on('submit', function(e){
    var submit = (LoginModalController.activeTab.text());
    
    if(submit == "Login"){
    console.log(submit);
    e.preventDefault();
    var userText = $("#login_username").val();
    var userPass = $("#user-pw").val();
    var data = {
   		email: userText, password:userPass, submit: submit
    };
    
    $.ajax({
     	url: "api/api.php",
    	type:"GET",
    	data: data, 
    	dataType: "JSON",
    	success: function(result, textStatus, xhr){
    	             
    	console.log(result);
    	if(result.location){
    window.location = (result.location);
    }
    else {
    	$("#heading_login").html(result);
    }
    }, 
    error: function(xhr, desc, err) {
        		console.log(xhr);
        		console.log(desc);
                console.log(err);
				console.log(this.url);
    
    }
    });
    }
else if(submit == "Sign Up"){
    console.log(submit);
    e.preventDefault();
    var userText = $("#username").val();
    var userPass = $("#password").val();
    var pass2 = $("#repeat_pass").val();
    var data = {
   		email: userText, password:userPass, repeat_pass: pass2, submit: submit
    };
    console.log(data);
    $.ajax({
     	url: "api/api.php",
    	type:"GET",
    	data: data, 
    	dataType: "JSON",
    	success: function(result, textStatus, xhr){
    	
    	console.log(this.url);             
    	console.log(result);
    	if(result.location){
    window.location = (result.location);
    }
    else {
    	$("#heading_signup").html(result);
    

      }
    
    }
    });
    }
    });
    });
    
    
    