
console.log('5a-testtableauheatmap.js');

$.post("heatmap-getdata.php", function (data) {


	console.log(data);
	for (i = 0; i < data.length; i++) {
		vraisemblance = data[i]["vraisemblance"];
		// console.log("vraisemblance: ");
		// console.log(vraisemblance);

		gravite = data[i]["niveau_de_gravite"];
		// console.log("gravite: ");
		// console.log(gravite);

		mode_operatoire = data[i]["mode_operatoire"];
		// console.log("mode_operatoire: ");
		// console.log(mode_operatoire);
		// datatableau

		var br = document.createElement("br");
		switch (gravite) {
			case '1':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2) > div")
						parent.append(mode_operatoire, br)
						console.log(mode_operatoire, br);

						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3) > div")
						parent.append(mode_operatoire, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4) > div")
						parent.append(mode_operatoire, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5) > div")
						parent.append(mode_operatoire, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6) > div")
						parent.append(mode_operatoire, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '2':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2) > div")
						parent.append(mode_operatoire, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3) > div")
						parent.append(mode_operatoire, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4) > div")
						parent.append(mode_operatoire, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5) > div")
						parent.append(mode_operatoire, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6) > div")
						parent.append(mode_operatoire, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '3':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2) > div")
						parent.append(mode_operatoire, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3) > div")
						parent.append(mode_operatoire, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4) > div")
						parent.append(mode_operatoire, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5) > div")
						parent.append(mode_operatoire, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6) > div")
						parent.append(mode_operatoire, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '4':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(2) > div")
						parent.append(mode_operatoire, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(3) > div")
						parent.append(mode_operatoire, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(4) > div")
						parent.append(mode_operatoire, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(5) > div")
						parent.append(mode_operatoire, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(6) > div")
						parent.append(mode_operatoire, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '5':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(2) > div")
						parent.append(mode_operatoire, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(3) > div")
						parent.append(mode_operatoire, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(4) > div")
						parent.append(mode_operatoire, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(5) > div")
						parent.append(mode_operatoire, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(1) > td:nth-child(6) > div")
						parent.append(mode_operatoire, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			// default:
			// 	console.log(`Sorry, we are out of ${expr}.`);
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
