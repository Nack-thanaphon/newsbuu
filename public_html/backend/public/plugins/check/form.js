// JavaScript Document
function checkeng(elem) {
     var str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("English only!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 
function checkenum(elem) {
     var str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("English and numbers only!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 
function checkenum2(elem) {
     var str="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("English uppercase And numbers only!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 

function checkslug(elem) {
     var str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
		  
           return false
     } 
		  
	 return true
}
function checkfolder(elem) {
     var str="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
		  
           return false
     } 
		  
	 return true
} 

function checkth(elem) {
     var str=" ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬ" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("Thai only!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 
function checknum(elem) {
     var str="0123456789" 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("Only numbers!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 
function checkprice(elem) {
     var str="0123456789." 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("Only numbers and decimal places!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 

function checknum_comma(elem) {
     var str="0123456789," 
     var val=elem.value
     var valOK = true;
     
     for (i=0; i<val.length & valOK; i++){
           valOK = (str.indexOf(val.charAt(i))!= -1) 
     }
     
     if (!valOK) {
           alert("Only numbers and comma (,) only!")
           elem.focus()
		   elem.value=val.substring(0, val.length-1);
           return false
     } return true
} 


function emailValidator(elem){ 
		var emailExp = /^[^@ ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int)$/;
			if(elem.match(emailExp)){
				return false;
			} else
				return true;
}
