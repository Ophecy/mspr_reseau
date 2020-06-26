const get = (url, params, callback) => {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function () { //Appelle une fonction au changement d'état.
		if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			console.log(xhr.response);

			callback(xhr.status, xhr.response);
		}
	}
	xhr.send(params);
};

function login() {
	let loginid = document.getElementById("user-log");
	let loginpw = document.getElementById("pwd-log");
	let loginota = document.getElementById("ota-log");
	get(
		`traitement/userauth.php`,
		`action=login&usr=${loginid.value}&pwd=${loginpw.value}&ota=${loginota.value}`,
		function (s, r) {
			r = JSON.parse(r);
			console.log(r);
			if (r.success) {
				window.location.reload();
			} else {
				alert(r.error);
			}

			// alert(r.error);
		}
	);
}
function logout() {
	get(
		`traitement/userauth.php`,
		`action=logout`,
		function (s, r) {
			r = JSON.parse(r);
			console.log(r);
			if (r.success) {
				window.location.reload();
			} else {
				alert(r.error);
			}
			// 
		}
	);
}
