function surligne(champ, erreur)
{
	if(erreur)
		champ.style.backgroundColor = "#fba";
	else
		champ.style.backgroundColor = "";
}

function verifNom(champ)
{
	if(champ.value.length < 2 || champ.value.length > 15)
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
}

function verifMdp(champ, champBis)
{
	if(champ.value != champBis.value)
	{
		surligne(champ, true);
		surligne(champBis, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
}

function verifPasVide(champ)
{
	if(champ.value == '')
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
}
function verifPasVideFichier(champ)
{
	if(champ.value == '')
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
	
}
function verifPasVideMot(champ)
{
	if(champ.value.length == 0 || champ.value.length>39)
	{
		surligne(champ, true);
		return false;
	}
	else
	{
		surligne(champ, false);
		return true;
	}
	
}
function verifForm(f, i)
{
	if(i == 0)
	{
		var nomOk = verifNom(f.nom);
		var prenomOk = verifNom(f.prenom);
		var mdpOk = verifMdp(f.pass, f.pass2);
		var mailOk = verifNom(f.mail);
		var promoOk = verifPasVide(f.promotion);
		var parcoursOk = true;
		if(f.promotion.value=="SI5" || f.promotion.value=="IFI"){
			parcoursOk = verifPasVide(f.parcoursSI);
		}
		else if(f.promotion.value=="ELEC5") {
			parcoursOk = verifPasVide(f.parcoursELEC);
		}
		else if(f.promotion.value=="MAM5"){
			parcoursOk = verifPasVide(f.parcoursMAM);
		}
		var cvOk = verifPasVideFichier(f.cv);
		var mot1 = verifPasVideMot(f.motcles1);
		var mot2 = verifPasVideMot(f.motcles2);
		
		if(nomOk && mdpOk && mailOk && prenomOk && promoOk && cvOk && mot1 && mot2 && parcoursOk){
			return true;
		}
		else
		{
			alert("Veuillez remplir correctement tous les champs");
			return false;
		}
	}
	else if(i == 1)
	{
		var nomOk = verifNom(f.nom);
	    var prenomOk = verifNom(f.prenom);
	    var mailOk = verifNom(f.mail);
	    var promoOk = verifPasVide(f.promotion);
	    var textOk = verifPasVide(f.message);
	   
		var mailOk = verifMail(f.mail);
		var mdpOk = verifNom(f.pass);
	
		if(promoOk && mailOk && nomOk && prenomOk && textOk)
			return true;
		else
		{
			alert("Veuillez remplir correctement tous les champs");
			return false;
		}
	}
	else if(i == 2)
	{
		var mailOk = verifPasVide(f.mail);
		var mdpOk = verifPasVide(f.pass);
		
		if(mdpOk && mailOk)
			return true;
		else
		{
			alert("Veuillez remplir correctement tous les champs");
			return false;
		}
	}
}