
console.log('5a-testtableauheatmap.js');

$.post("heatmap-getdata.php", function (data) {


	// console.log(data);
	// console.log(data['data_dim']);
	// console.log(data['data_cell']);


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




					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-orange')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')
					break;

				case "5":
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
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





					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')
					break;

				case "5":
					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

					document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-orange')
					document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
					break;
			}
			break;
		default:
			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
			document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
			document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
			document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

			document.querySelector("#dataTable > tbody > tr:nth-child(2) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-orange')
			document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
			break;
	}







	for (i = 0; i < data['data_cell'].length; i++) {
		vraisemblance = data['data_cell'][i]["vraisemblance"];
		// console.log("vraisemblance: ");
		// console.log(vraisemblance);

		gravite = data['data_cell'][i]["niveau_de_gravite"];
		// console.log("gravite: ");
		// console.log(gravite);

		id_risque = data['data_cell'][i]["id_risque"];
		// console.log("id_risque: ");
		// console.log(id_risque);
		// datatableau

		var br = document.createElement("br");
		switch (gravite) {
			case '1':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable > tbody > tr:nth-child(6) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						console.log(id_risque, br);

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
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
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
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
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
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
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
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
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
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			// default:
			// 	console.log(`Sorry, we are out of ${expr}.`);
		}

	}

	// console.log(parseInt(echelle_gravite));
	// console.log(parseInt(echelle_vraisemblance));

	for (let i = 1; i <= (parseInt(echelle_gravite)); i++) {

		// console.log('gravite: ' + i);

		for (let j = 1; j <= (parseInt(echelle_vraisemblance)); j++) {

			console.log('vraisemblance: ' + j);

			
			console.log(document.getElementById("dataTable").rows[i].cells[j]);
			document.getElementById("dataTable").rows[i].cells[j].addEventListener('click', function () {
				
				var case_echelle_gravite = i
				console.log(case_echelle_gravite);
				
				var case_echelle_vraisemblance = j
				console.log(case_echelle_vraisemblance);
				
				sleep(100).then(() => {
					var case_couleur = document.getElementById("dataTable").rows[i].cells[j].classList[0]
					console.log(case_couleur);
					
					
					
					$.ajax({
						url: 'content/php/atelier5b/ajax-heatmap.php',
						type: 'POST',
						data: {
							case_echelle_gravite: case_echelle_gravite,
							case_echelle_vraisemblance: case_echelle_vraisemblance,
							case_couleur: case_couleur
						},
						success: function () {
							console.log('traitement du barème fait');
						}
					});
					
				});
			})
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







