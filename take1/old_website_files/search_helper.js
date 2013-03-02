var companies = new Array("Payson Diesel", "Shannon CPA's & Associates", "Mountain Loan Centers (Provo)");
var contacts = new Array("Robyn", "April", "Shaunae");

function useThis() {
	alert('aTag');
}

function search_help(partText, elemid, arraytouse) {
	for(index in arraytouse) {
		if (index == 0) {
			document.getElementById(elemid).innerHTML = '';
		}
		var name = arraytouse[index].toLowerCase();
		var compText = partText.toLowerCase()
		if (name.indexOf(compText) != -1) {
			document.getElementById(elemid).style.display = "";
			/*pTAG = document.createElement("p");
			pTAG.style.cursor = "pointer";
			pTAG.id = "p-tag-"+ index;
			pTAG.onclick = function () {alert('aaa')};
			aTAG = document.createElement("a");
			aTAG.href = "#";
			aTAG.style.whiteSpace = "nowrap"
			aTAG.style.marginTop = "5px";
			aTAG.textContent = arraytouse[index];
			pTAG.appendChild(aTAG);
			document.getElementById(elemid).appendChild(pTAG);*/
			document.getElementById(elemid).innerHTML += '<p><a style="white-space:nowrap; margin-top:5px;" href="javascript: alert(\'asdf\')">' + arraytouse[index] + '</a></p>';
		}
	}
	
	if (document.getElementById(elemid).innerHTML == "") {
		document.getElementById(elemid).style.display = "none";
	}
}

function end_search(elemid) {
	document.getElementById(elemid).style.display = "none";
}