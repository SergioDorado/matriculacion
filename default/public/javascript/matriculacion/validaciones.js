function CuilH(dni,cuil1)//calcula el cuil de Hombres
{
    if(documento_nrodoc.value.length == 8)
    {
        var doc= document.getElementById(""+dni.id+"");
        var inpcuil= document.getElementById(""+cuil1.id+"");
        var com = [20];
        var vec = [5,4,3,2,7,6,5,4,3,2];
        var total = 0;
        var cuil;
        docum = doc.value;
        com= ""+com+docum;
        for (var i=0;i < vec.length; i++)
        {
            total += parseInt(com[i])*vec[i];
        }

        var mod = total % 11;
        if (mod == 0)
        {
            cuil=com+"0";
        }
        else
        {
            if (mod ==1)
            {
              cuil = "23"+doc.value+"9";  
            }
            else
            {
                var Z = 11-mod;
                cuil= ""+com+Z;
            }
        }
        inpcuil.value= cuil;  
    }
    else
    {
        matriculado_dni.focus();
        matriculado_sexo0.checked=false;
    }
}

function CuilM(dni,cuil1) //calcula el cuil Mujeres
  { 
      if(documento_nrodoc.value.length == 8)
      {
          var doc= document.getElementById(""+dni.id+"");
          var inpcuil= document.getElementById(""+cuil1.id+"");
          var com = [27];
          var vec = [5,4,3,2,7,6,5,4,3,2];
          var total = 0;
          var cuil;            
              docum = doc.value;
              com= ""+com+docum;
              for (var i=0;i < vec.length; i++)
              {
                  total += parseInt(com[i])*vec[i];
              }

              var mod = total % 11;
              if (mod == 0)
              {
                  cuil=com+"0";
              }
              else
              {
                  if (mod ==1)
                  {
                    cuil = "23"+doc.value+"4";  
                  }
                  else
                  {
                      var Z = 11-mod;
                      cuil= ""+com+Z;
                  }
              }
              inpcuil.value= cuil; 
      }
      else
      {
          matriculado_dni.focus();
          matriculado_sexo1.checked=false;
      }

  }
  
     function valideKey(evt) //solo numeros
    {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if(code==8)
        {
            //backspace
            return true;
        }
        else if(code>=48 && code<=57)
        {
            //es numerp
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
        function valideKey2(evt) //solo letras
    {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if(code==8)
        {
            //backspace
            return true;
        }
        else if((code>=65 && code<=90)||(code>=97 && code<=122))  
        {
            //letra mayuscula y minuscula
            return true;
        }
        else if(code==32){
            //espacio
            return true;
        }
        else        
            //return false;
            if((code==241)||(code==209)||(code==220)||(code==252)||(code==164)||(code==165)||(code==154)||(code==129))
            {
                
               return true; 
            }
            else {
              //alert(code);
                return false;}
    }
	
	function validarEmail2(email,idmail) {
	var cod; 
        var correo = document.getElementById(""+idmail.id+"");// obtiene el id del elemtto donde aparecera el msj de error
        correo.style.color="red";
        
        
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	yahoo =/yahoo/;
        hotmail=/hotmail/;
        gmail=/gmail/;
        outlook=/outlook/;
        
        // codificacion de los dominios
	if ( yahoo.test(email) ){
	  cod=1;
	}
        if ( hotmail.test(email) ){
	  cod=2;
	}
        if ( gmail.test(email) ){
	  cod=3;
	}
        if ( outlook.test(email) ){
	  cod=4;
	}
        
        //control de formato de e-mail (xxx@xxx.xxx)
    if ( !expr.test(email) ){
        correo.innerHTML="Error: La dirección de correo [" + email + "] es incorrecta";
        
		return false;
		}
		
	switch(cod)	{
		case 1:{
			    yahoo=/yahoo.com.ar/;
                            if(!yahoo.test(email)){
                                correo.innerHTML="yahoo invalido";
                                return false;
                            }
                            else{
                                correo.innerHTML="";
                                return true;}
                            ; break;
		       }
                case 2:{
                         hot=/hotmail.com/;
                         hot2=/hotmail.com.ar/;
                         if((!hot.test(email)&&(!hot2.test(email)))){
                             correo.innerHTML="hotmail invalido";
                             return false;
                         }
                         else{
                             correo.innerHTML="";
                             return true;}
                         ;break;
                       }
                case 3:{
                        gmail=/gmail.com/;
                        if(!gmail.test(email)){
                            correo.innerHTML="Gmail invalido";
                            return false;
                        } 
                        else{
                            correo.innerHTML="";
                            return true;}
                        break;
                }
                       default: {
                               correo.innerHTML="";
                               return true;}
	}
		
}
