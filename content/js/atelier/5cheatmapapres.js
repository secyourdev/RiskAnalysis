
console.log('5a-testtableauheatmap.js');

$.post("heatmap-getdata_apres.php", function (data) {

	console.log('bonjour');
	// console.log(data);
	// console.log(data['data_dim']);
	// console.log(data['data_cell']);


	for (i = 0; i < data['data_dim'].length; i++) {
		echelle_vraisemblance = data['data_dim'][i]['echelle_vraisemblance'];
		echelle_gravite = data['data_dim'][i]['echelle_gravite'];
	}

	switch (echelle_gravite) {
		case "4":
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(1)").remove()
			switch (echelle_vraisemblance) {
				case "4":
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(1) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(7) > td:nth-child(6)").remove()




					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-orange')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')
					break;

				case "5":
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
					break;
			}
			break;

		case "5":
			switch (echelle_vraisemblance) {
				case "4":
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(1) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6)").remove()
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(7) > td:nth-child(6)").remove()





					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')
					break;

				case "5":
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

					document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-orange')
					document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
					break;
			}
			break;
		default:
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(2)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2)").classList.add('fond-vert')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2)").classList.add('fond-vert')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2)").classList.add('fond-vert')

			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3)").classList.add('fond-vert')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3)").classList.add('fond-vert')

			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(4)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4)").classList.add('fond-vert')

			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(5)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5)").classList.add('fond-orange')

			document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6)").classList.add('fond-rouge')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6)").classList.add('fond-orange')
			document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6)").classList.add('fond-orange')
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
		// dataTable_apresau

		var br = document.createElement("br");
		switch (gravite) {
			case '1':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						console.log(id_risque, br);

						break;
					case '2':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(6) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '2':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(5) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '3':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(4) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '4':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(3) > td:nth-child(6) > div")
						parent.append(id_risque, br)
						break;
					// default:
					// 	console.log(`Sorry, we are out of ${expr}.`);
				}
				break;
			case '5':
				switch (vraisemblance) {
					case '1':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(2) > div")
						parent.append(id_risque, br)
						break;
					case '2':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(3) > div")
						parent.append(id_risque, br)
						break;
					case '3':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(4) > div")
						parent.append(id_risque, br)
						break;
					case '4':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(5) > div")
						parent.append(id_risque, br)
						break;
					case '5':
						parent = document.querySelector("#dataTable_apres > tbody > tr:nth-child(2) > td:nth-child(6) > div")
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

	console.log(parseInt(echelle_gravite));
	console.log(parseInt(echelle_vraisemblance));





	if (data['bareme_exist']) {
		console.log("if (data['bareme_exist']) : ");

		for (i = 0; i < data['bareme_exist'].length; i++) {
			console.log(data['bareme_exist'][i]);

			bareme_vraisemblance = parseInt(data['bareme_exist'][i]['bareme_vraisemblance']);
			console.log(bareme_vraisemblance);
			bareme_gravite = parseInt(data['bareme_exist'][i]['bareme_gravite']);
			console.log(bareme_gravite);
			bareme_bareme = data['bareme_exist'][i]['bareme_bareme'];
			console.log(bareme_bareme);


			switch (bareme_gravite) {
				case 5:
					$gravite_to_print = 2
					console.log("$gravite_to_print = 2");
					break;
				case 4:
					$gravite_to_print = 3
					console.log("$gravite_to_print = 3");
					break;
				case 3:
					$gravite_to_print = 4
					console.log("$gravite_to_print = 4");

					break;
				case 2:
					$gravite_to_print = 5
					console.log("$gravite_to_print = 5");
					break;
				case 1:
					$gravite_to_print = 6
					console.log("$gravite_to_print = 6");
					break;
			}
			$vraisemblance_to_print = bareme_vraisemblance + 1;

			$("#dataTable_apres > tbody > tr:nth-child(" + $gravite_to_print + ") > td:nth-child(" + $vraisemblance_to_print + ")").removeClass().addClass(bareme_bareme);
			console.log($("#dataTable_apres > tbody > tr:nth-child(" + $gravite_to_print + ") > td:nth-child(" + $vraisemblance_to_print + ")"));

		}

	}















	for (let i = 2; i <= (parseInt(echelle_vraisemblance)) + 1; i++) {
		// console.log('gravite: ' + i);

		for (let j = 2; j <= (parseInt(echelle_vraisemblance)) + 1; j++) {
			// console.log('vraisemblance: ' + j);

			$("#dataTable_apres > tbody > tr:nth-child(" + i + ") > td:nth-child(" + j + ")").on('click', function () {

				sleep(100).then(() => {

					$color_to_send = $("#dataTable_apres > tbody > tr:nth-child(" + i + ") > td:nth-child(" + j + ")")[0].classList[0];

					switch (i) {
						case 2:
							$gravite_to_send = 5
							break;
						case 3:
							$gravite_to_send = 4
							break;
						case 4:
							$gravite_to_send = 3
							break;
						case 5:
							$gravite_to_send = 2
							break;
						case 6:
							$gravite_to_send = 1
							break;
					}
					console.log($color_to_send);

					$.ajax({
						url: 'content/php/atelier5b/ajax-heatmap.php',
						type: 'POST',
						data: {
							case_echelle_gravite: $gravite_to_send,
							case_echelle_vraisemblance: j - 1,
							case_couleur: $color_to_send
						},
						success: function () {
							console.log('traitement du barème fait');
						}
					});
				});

			});

		}
	}


})

$('table').on('click', "td", function () {
	if ($(this).hasClass('fond-vert')) {
		// console.log($(this)[0].parentNode.firstElementChild.textContent);
		$(this).removeClass('fond-vert').addClass('fond-orange');
	} else if ($(this).hasClass('fond-orange')) {
		// console.log($(this)[0].parentNode.firstElementChild.textContent);
		$(this).removeClass('fond-orange').addClass('fond-rouge');
	} else if ($(this).hasClass('fond-rouge')) {
		// console.log($(this)[0].parentNode.firstElementChild.textContent);
		$(this).removeClass('fond-rouge').addClass('fond-vert');
	}
});







