
$.post("heatmap-getdata.php", function (data) {
	for (i = 0; i < data['data_dim'].length; i++) {
		echelle_vraisemblance = data['data_dim'][i]['echelle_vraisemblance'];
		echelle_gravite = data['data_dim'][i]['echelle_gravite'];
	}

	switch (echelle_gravite) {
		case "4":
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			switch (echelle_vraisemblance) {
				case "4":
					document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(6)").remove()
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6)").remove()
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6)").remove()
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6)").remove()
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6)").remove()
					document.querySelector("#dataTable > tbody > tr:nth-child(7) > td:nth-child(6)").remove()
					break;

				case "5":
					break;
			}
		break;
		case "5":
				switch (echelle_vraisemblance) {
					case "4":
						document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6)").remove()
						document.querySelector("#dataTable > tbody > tr:nth-child(7) > td:nth-child(6)").remove()
						break;

					case "5":
						break;
				}
		break;
		default:
			break;
	}




	for (i = 0; i < data['data_cell'].length; i++) {
		vraisemblance = data['data_cell'][i]["vraisemblance"];
		gravite = data['data_cell'][i]["niveau_de_gravite"];
		id_risque = data['data_cell'][i]["id_risque"];

		var br = document.createElement("br");
		switch (gravite) {
			case '1':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
				}
				break;
			case '2':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
				}
				break;
			case '3':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
				}
				break;
			case '4':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
				}
				break;
			case '5':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
				}
				break;
		}

	}

})

$('table').on('click', "td", function () {
	if ($(this).hasClass('fond-vert')) {
		$(this).removeClass('fond-vert').addClass('fond-orange');
	} else if ($(this).hasClass('fond-orange')) {
		$(this).removeClass('fond-orange').addClass('fond-rouge');
	} else if ($(this).hasClass('fond-rouge')) {
		$(this).removeClass('fond-rouge').addClass('fond-vert');
	}
});
