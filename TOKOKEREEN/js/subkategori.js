// if the var subCounter exists use that one, otherwise default to 1

var counter = 1;
if (parseInt(subCounter) > 1) {
counter = parseInt(subCounter);
}

var limit = 10000;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br> <h3>Subkategori : " + (counter + 1) + "</h3>" + " <br><input class='ccformfield' placeholder='Subkategori' type='text' name='sk_kode["+counter+"]'>"
          + " <h3>Nama Subkategori : " +"<br>" +  " <br><input class='ccformfield' placeholder='Nama Subkategori' type='text' name='sk_nama["+counter+"]'>"+ "<br><br>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
