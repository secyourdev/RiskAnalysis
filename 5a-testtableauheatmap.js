﻿
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


	// define colors
// 	var colors = {
// 		"critical": "#ca0101",
// 		"bad": "#e17a2d",
// 		"medium": "#e1d92d",
// 		"good": "#5dbe24",
// 		"verygood": "#0b7d03"
// 	};

// 	var datatableau = [{
// 		"x": "Very good",
// 		"y": "Critical",
// 		"color": colors.medium,
// 		"value": ""
// 	}, {
// 		"x": "Very good",
// 		"y": "Bad",
// 		"color": colors.good,
// 		"value": ""
// 	}, {
// 		"x": "Very good",
// 		"y": "Medium",
// 		"color": colors.verygood,
// 		"value": ""
// 	}, {
// 		"x": "Very good",
// 		"y": "Good",
// 		"color": colors.verygood,
// 		"value": ""
// 	}, {
// 		"x": "Very good",
// 		"y": "Very good",
// 		"color": colors.verygood,
// 		"value": ""
// 	},

// 	{
// 		"x": "Good",
// 		"y": "Critical",
// 		"color": colors.bad,
// 		"value": ""
// 	}, {
// 		"x": "Good",
// 		"y": "Bad",
// 		"color": colors.medium,
// 		"value": ""
// 	}, {
// 		"x": "Good",
// 		"y": "Medium",
// 		"color": colors.good,
// 		"value": ""
// 	}, {
// 		"x": "Good",
// 		"y": "Good",
// 		"color": colors.verygood,
// 		"value": ""
// 	}, {
// 		"x": "Good",
// 		"y": "Very good",
// 		"color": colors.verygood,
// 		"value": ""
// 	},

// 	{
// 		"x": "Medium",
// 		"y": "Critical",
// 		"color": colors.bad,
// 		"value": ""
// 	}, {
// 		"x": "Medium",
// 		"y": "Bad",
// 		"color": colors.bad,
// 		"value": ""
// 	}, {
// 		"x": "Medium",
// 		"y": "Medium",
// 		"color": colors.medium,
// 		"value": ""
// 	}, {
// 		"x": "Medium",
// 		"y": "Good",
// 		"color": colors.good,
// 		"value": ""
// 	}, {
// 		"x": "Medium",
// 		"y": "Very good",
// 		"color": colors.good,
// 		"value": ""
// 	},

// 	{
// 		"x": "Bad",
// 		"y": "Critical",
// 		"color": colors.critical,
// 		"value": ""
// 	}, {
// 		"x": "Bad",
// 		"y": "Bad",
// 		"color": colors.critical,
// 		"value": ""
// 	}, {
// 		"x": "Bad",
// 		"y": "Medium",
// 		"color": colors.bad,
// 		"value": ""
// 	}, {
// 		"x": "Bad",
// 		"y": "Good",
// 		"color": colors.medium,
// 		"value": ""
// 	}, {
// 		"x": "Bad",
// 		"y": "Very good",
// 		"color": colors.good,
// 		"value": ""
// 	},

// 	{
// 		"x": "Critical",
// 		"y": "Critical",
// 		"color": colors.critical,
// 		"value": ""
// 	}, {
// 		"x": "Critical",
// 		"y": "Bad",
// 		"color": colors.critical,
// 		"value": ""
// 	}, {
// 		"x": "Critical",
// 		"y": "Medium",
// 		"color": colors.critical,
// 		"value": ""
// 	}, {
// 		"x": "Critical",
// 		"y": "Good",
// 		"color": colors.bad,
// 		"value": ""
// 	}, {
// 		"x": "Critical",
// 		"y": "Very good",
// 		"color": colors.medium,
// 		"value": ""
// 	}
// 	];
})