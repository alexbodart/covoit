$(document).ready(function(){

	var idUser = document.getElementById('idUser').text;

	$.post("./libs/dataNbTrajetConducteur.php",{idUser : idUser}, function(data,status) {
		console.log("data = "+data);
		$("#nbTrajetConducteur").text(data);
	});

	$.post("./libs/dataNbTrajetPassager.php",{idUser : idUser}, function(data,status) {
		console.log("data = "+data);
		$("#nbTrajetPassager").text(data);
	});

	$.post("./libs/dataNbPassagersTransportes.php",{idUser : idUser}, function(data,status) {
		console.log("data = "+data);
		$("#nbPassagersTransportes").text(data);
	});

	$(".plusDetails").on({

		click: function(ref) {

			console.log(($(this)[0].id));
			var id = ($(this)[0].id);
			$(".tripList").innerHTML='<h1>coucou</h1>';
		}
	})

}); 