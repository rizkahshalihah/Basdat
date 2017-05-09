var counter = 1;
var limit = 10000;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br> <h3>Subkategori : " + (counter + 1) + "</h3>" + " <br><input class='ccformfield' placeholder='Subkategori' type='text' name='myInputs[]'>" 
          + " <h3>Kode Subkategori : " +"<br>" +  " <br><input class='ccformfield' placeholder='Kode Subkategori' type='text' name='myInputs[]'>"
          + " <h3>Nama Subkategori : " +"<br>" +  " <br><input class='ccformfield' placeholder='Nama Subkategori' type='text' name='myInputs[]'>"+ "<br><br>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}

function addDropDown(){
	alert("HM");
	
}




	
				