<script language="javascript">
  function RedirectWebsite(){  
  switch(document.getElementById('s1').value)
    {
      case "Home":
      window.location="/home.html";
      break; 
      case "Trascript":
      window.location="/validate.html";
      break;
      case "Hireme":
      window.location="/resume.html";
      break;
      case "Project01":
      window.location="/project01.html";
      break;
      case "Project02":
      window.location="/project02.html";
      break;
      default:
      window.location="/home.html"; 
      break;
    }
  }

  function validate(){
		  let password = document.getElementById("pass").value;
		  if (password === 'lamnguyen'){
			  window.location.href ="/transcript.html";
		  }
		  else{
			  alert("Wrong password. Access denied!");
			  return false;
		  }
	}

    function validation() {  
        var id=document.user-login.user.value;  
        var ps=document.user-login.pass.value;  
        if(id.length=="" && ps.length=="") {  
            alert("User Name and Password fields are empty");  
            return false;  
        }  
        else  
        {  
            if(id.length=="") {  
                alert("User Name is empty");  
                return false;  
            }   
            if (ps.length=="") {  
            alert("Password field is empty");  
            return false;  
            }  
        }                             
    } 
  </script>