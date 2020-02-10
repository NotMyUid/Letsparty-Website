(function welcomeBack(){  
	if(document.referrer.includes("Login")){
        document.addEventListener('DOMContentLoaded', function() {
            alert("Welcome back !");
        }, false);
      }
})();