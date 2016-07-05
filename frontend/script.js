/* find out browser name and version */
navigator.sayswho = (function () {
	var ua = navigator.userAgent, tem,
		M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
	if (/trident/i.test(M[1])) {
		tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
		return 'IE ' + (tem[1] || '');
	}
	if (M[1] === 'Chrome') {
		tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
		if (tem != null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
	}
	M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
	if ((tem = ua.match(/version\/(\d+)/i)) != null) M.splice(1, 1, tem[1]);
	return M.join(' ');
})();

(function () {
	str = "";
	str += "Screen: " + screen.width + "x" + screen.height;
	str += " &bull; Viewport: " + window.innerWidth + "x" + window.innerHeight;
	str += " &bull; Browser: " + navigator.sayswho + " " + (navigator.userAgent.indexOf('Mac OS') != -1 ? "Mac" : "PC");
	str += " &bull; " + round(detectZoom.zoom() * 100, 2) + "% Zoom";
	str += " &bull; <span class='link' onclick='sketch_toggle_guides()'>Toggle guides</span>";

	document.getElementById("userData").innerHTML = str;

	if(localStorage["sketch_info_state"] == "close"){
		sketch_info_close();
	}

})();

function sketch_info_open() {
	document.getElementById("userData").className = "";
	document.getElementById("closeBtn").style.display = "block";
	document.getElementById("openBtn").style.display = "none";

	localStorage["sketch_info_state"] = "open";
}

function sketch_info_close() {
	document.getElementById("userData").className = "hidden";
	document.getElementById("closeBtn").style.display = "none";
	document.getElementById("openBtn").style.display = "block";

	localStorage["sketch_info_state"] = "close";
}

function sketch_toggle_guides() {
	var bLinesHidden = document.body.className == "hideGuides"
	document.body.className = (bLinesHidden ? "" : "hideGuides");

}

function sketch_init_viewport(){
	var img = document.getElementById("img"),
		bg = document.getElementById("bg");

	console.log(img.height)
	bg.style.height = img.height + "px";
}

function round(value, exp) {
	if (typeof exp === 'undefined' || +exp === 0)
		return Math.round(value);

	value = +value;
	exp = +exp;

	if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
		return NaN;

	// Shift
	value = value.toString().split('e');
	value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

	// Shift back
	value = value.toString().split('e');
	return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}