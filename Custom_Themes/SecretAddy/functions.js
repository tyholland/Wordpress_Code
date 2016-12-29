// JavaScript Document

function Open(name)
{
	var el = $('.' + name).css("display");
	
	if ( el == 'none' )
	{
		$('.' + name).css("display", "block"); 
	}
	else
	{
		$('.' + name).css("display", "none"); 
	} 
} 

function changeHomepic()
{
	$("#hmpic" + currentHome).fadeOut("slow", function() {
			if (currentHome >= homeImages)
			{
					currentHome = 0;
			}
			$("#hmpic" + (currentHome + 1) ).fadeIn("slow", function() {
					currentHome++;
			});
	});
}   

function changeImage()
{
	$("#img" + currentImage).fadeOut("slow", function() {
			if (currentImage >= numImages)
			{
					currentImage = 0;
			}
			$("#img" + (currentImage + 1) ).fadeIn("slow", function() {
					currentImage++;
			});
	});
}

function getPage(page, id) {
  var xmlhttp=false; //Clear our fetching variable
  try {
    //Try the first kind of active x object 
    xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); 
  } catch (e) {    
    try {
      //Try the second kind of active x object
      xmlhttp = new ActiveXObject('Microsoft.XMLHTTP'); 
    } catch (E) {
      xmlhttp = false;
    }
  }
 
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  var file = page; 
  xmlhttp.open('GET', file, true);   
  xmlhttp.onreadystatechange=function() {
    //Check if it is ready to recieve data
    if (xmlhttp.readyState==4) { 
      var content = xmlhttp.responseText;
      if( content ) { 
        document.getElementById(id).innerHTML = content; 
      }
    }
  }
  xmlhttp.send(null) //Nullify the XMLHttpRequest
  return;
}

function chat() {  
  var user1 = document.getElementById('user1').value;
  var user2 = document.getElementById('user2').value; 
  var id = document.getElementById('id').value;
  var message = document.getElementById('message').value;

  getPage("message.php?user1=" + user1 + "&user2=" + user2 + "&id=" + id + "&message=" + message,"screen");
  document.getElementById('message').value = "";

}

function message() {  
  var user1 = document.getElementById('user1').value;
  var id = document.getElementById('id').value;
  var message = document.getElementById('empty').value;

  getPage("message.php?user1=" + user1 + "&id=" + id + "&message=" + message,"screen");
  document.getElementById('receive').style.visibility='hidden';

}

function getMessage() {  
  var id = document.getElementById('id').value;
  getPage("message.php?id=" + id,"screen");
}

function homePage() 
{
  window.location = "<?php echo get_option('siteurl'); ?>/profile";
}

function showPopup(url) 
{
  newwindow = window.open(url,'name','height=400px,width=700px,left=300px,resizable,scrollbars=yes');
  if (window.focus)
  {
	newwindow.focus();
  }
}

function showChat(url, name) 
{
    newwindow = window.open(url,name,'height=480px,width=520px,left=300px,resizable,scrollbars=yes');
    if (window.focus)
    {
      newwindow.focus();
    }
}

function friendCheck(formobj)
{                                                                                                                               
  friend1 = document.friendEmail.friend1.value;                                                                                                                
  friend2 = document.friendEmail.friend2.value;                                                                                                          
  friend3 = document.friendEmail.friend3.value;                                                                                                                    
  friend4 = document.friendEmail.friend4.value;                                                                                                                   
  friend5 = document.friendEmail.friend5.value;                                                                                                                                                           
  
  msg = "";                                                                                                                                                
  
  if ( (friend1 == "") && (friend2 == "") && (friend3 == "") && (friend4 == "") && (friend5 == "") )                                                            
  {                                                                                                                                                        
    alert("You should choose at least one Friend.");                                               
    return false;                                                                                                                                          
  } 
  if ( (friend1 != "") )                                                            
  {                                                                                                                                                                 
    pos = friend1.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address for Friend 1.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = friend1.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = friend1.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address for Friend 1.\n\n";                                                                                                                       
      }                                                                                                                                                      
    }                                                                                                                                          
  } 
  
  if ( (friend2 != "") )                                                            
  {                                                                                                                                                                 
    pos = friend2.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address for Friend 2.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = friend2.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = friend2.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address for Friend 2.\n\n";                                                                                                                       
      }                                                                                                                                                      
    }                                                                                                                                          
  }
  
  if ( (friend3 != "") )                                                            
  {                                                                                                                                                                 
    pos = friend3.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address for Friend 3.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = friend3.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = friend3.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address for Friend 3.\n\n";                                                                                                                       
      }                                                                                                                                                      
    }                                                                                                                                          
  }
  
  if ( (friend4 != "") )                                                            
  {                                                                                                                                                                 
    pos = friend4.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address for Friend 4.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = friend4.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = friend4.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address for Friend 4.\n\n";                                                                                                                       
      }                                                                                                                                                      
    }                                                                                                                                          
  }
  
  if ( (friend5 != "") )                                                            
  {                                                                                                                                                                 
    pos = friend5.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address for Friend 5.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = friend5.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = friend5.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address for Friend 5.\n\n";                                                                                                                       
      }                                                                                                                                                      
    }                                                                                                                                          
  }                                                                                                                                                          
                                                                                                                               
  if (msg == "")                                                                                                                                           
  {                                                                                                                                                        
    return true;                                                                                                                                           
  }                                                                                                                                                        
  else                                                                                                                                                     
  {                                                                                                                                                        
    alert(msg);                                                                                                                                            
    return false;                                                                                                                                          
  }                                                                                                                                                        
}

function contactCheck(formobj)
{                                                                                                                               
  email = document.contactform.Email.value;                                                                                                                             
  name = document.contactform.Name.value;                                                                                                                       
  message = document.contactform.Message.value;
  
  nameLen = name.length;   
  
  msg = "";  
                                                                              
  if (message == "")
  {
    alert("Please fill in the Message Field before submitting.");
    return false;
  }
  
  if (name == "")
  {
    msg += "";
  }
  else
  { 
    if ( nameString == false )                                                                                                                                       
    {                                                                                                                                                        
      msg += "Please Enter your Name.\n\n";                                                                                                               
    }
  }
  
  if (email == "")
  {
    msg += "";
  }
  else
  {                                                                                       
    pos = email.indexOf("@",0);                                                                                                                              
    if (pos == -1)                                                                                                                                           
    {                                                                                                                                                        
      msg += "Please enter a valid email address.\n\n";                                                                                                                   
    }                                                                                                                                                        
    else                                                                                                                                                     
    {                                                                                                                                                        
      pos2 = email.indexOf("@", pos + 1)                                                                                                                                                      
      pos3 = email.indexOf(".", pos + 1);                                                                                                                      
      diff = pos3 - pos;                                                                                                                     
      if (pos2 != -1 || diff <= 3)                                                                                                                                        
      {                                                                                                                                                      
        msg += "Please enter a valid email address.\n\n";                                                                                                                       
      }                                                                                                                                                      
    } 
  }                                                                                                                                                   
                                                                                     
  if (msg == "")                                                                                                                                           
  {                                                                                                                                                        
    return true;                                                                                                                                           
  }                                                                                                                                                        
  else                                                                                                                                                     
  {                                                                                                                                                        
    alert(msg);                                                                                                                                            
    return false;                                                                                                                                          
  }                                                                                                                                                        
}     

function registerCheck()
{                                                                                                                               
  email = document.registerform.email.value;                                                                                                                
  secretAddy = document.registerform.secret.value;                                                                                                          
  pwd = document.registerform.pwd.value;                                                                                                                    
  pwd2 = document.registerform.pwd2.value;                                                                                                                    
  maxAge = document.registerform.maxAge.checked;                                                                                                              
                                                                               
                                                                               
  msg = "";                                                                                                                                                
                                                                               
  if ( (secretAddy == "") && (maxAge == false) && (email == "") && (pwd == "") && (pwd2 == "") )                                                            
  {                                                                                                                                                        
    alert("You need to complete all these fields:\n\nSecretAddy Name\nPassword\nEmail\nTerms & Conditions\nVerify you are 18");                                               
    return false;                                                                                                                                          
  }    
  
  if ( secretAddy == "" )                                                                                                                                       
  {                                                                                                                                                        
    msg += "Please enter a username \n\n";                                                                                                               
  } 
  
  if ( pwd == "" )                                                                                                                                       
  {                                                                                                                                                        
    msg += "Please enter your password \n\n";                                                                                                               
  }   
  
  if ( pwd2 == "" )                                                                                                                                       
  {                                                                                                                                                        
    msg += "Please enter your confirmation password \n\n";                                                                                                               
  }      
                                                                               
  if ( pwd != pwd2 )                                                                                                                                       
  {                                                                                                                                                        
    msg += "Please verify that your passwords match \n\n";                                                                                                               
  }                                                                                                                                                     
                                                                               
  if ( maxAge == false )                                                                                                                                    
  {                                                                                                                                                        
    msg += "Please verify that you have read the Terms & Conditions Policy and are 18 years of age or older \n\n";                                                                      
  }                                                                                                                                                        
                                                                               
  pos = email.indexOf("@",0);                                                                                                                              
  if (pos == -1)                                                                                                                                           
  {                                                                                                                                                        
    msg += "Please enter a valid email address.\n\n";                                                                                                                   
  }                                                                                                                                                        
  else                                                                                                                                                     
  {                                                                                                                                                        
    pos2 = email.indexOf("@", pos + 1)                                                                                                                                                      
    pos3 = email.indexOf(".", pos + 1);                                                                                                                      
    diff = pos3 - pos;                                                                                                                     
    if (pos2 != -1 || diff <= 3)                                                                                                                                        
    {                                                                                                                                                      
      msg += "Please enter a valid email address.\n\n";                                                                                                                       
    }                                                                                                                                                      
  }                                                                                                                                                        
                                                                               
  if (msg == "")                                                                                                                                           
  {                                                                                                                                                        
    return true;                                                                                                                                           
  }                                                                                                                                                        
  else                                                                                                                                                     
  {                                                                                                                                                        
    alert(msg);                                                                                                                                            
    return false;                                                                                                                                          
  }                                                                                                                                                        
}    