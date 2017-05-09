var counter = 1;
var limit = 10000;

function addDropDown(divName){
	
	 if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     } 
	 else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br> <h3>Jasa Kirim " + (counter + 1) + ": " +"<br>" + "<div class ='form-group'>" +
		  " <select id='jasa-kirim' class='ccformfield'>" + "JASA KIRIM" +
		  "<span class='caret>" + "<option class='dropdown-menu'>" + "<option value='JNE REGULER'>JNE REGULER" + "<option value='JNE YES'>JNE YES" +
		  "<option value='TIKI REGULER'>TIKI REGULER" + "<option value='POS PAKET BIASA'>POS PAKET BIASA" + "<option value='POS PAKET KILAT'>POS PAKET KILAT" +
		  "<option value='WAHANA'>WAHANA" + "<option value='J&T EXPRESS'>J&T EXPRESS" + "<option value='PAHALA'>PAHALA" + "<option value='LION PARCEL'>LION PARCEL";  
		 		 
		document.getElementById(divName).appendChild(newdiv);
          counter++;
	
	}
}
