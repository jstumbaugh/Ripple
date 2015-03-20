var beginPlayer = '<div class="songPlayer"> <div class="songText"><iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/';
var endPlayer ='"></iframe></div><img class="drop" src="images/dropit.png"/></div>'


var songIdList = new Array();
songIdList.push("173752179");
songIdList.push("188883966");
songIdList.push("179501785");

function grabSong() {
	var songId = document.getElementById("songId").value;
	console.log("ADD SONG");
	getSongId(songId);
}


function addSong(songId) {
    var newcontent = document.createElement('div');
    newcontent.innerHTML = beginPlayer+songId+endPlayer;

    prependElement('songBox', newcontent);

	console.log("SONG ADDED");
	document.getElementById("songId").value="";
}

function prependElement(parentID, child){
	parent = document.getElementById(parentID);
	console.log(parent);
	console.log(child);
	parent.insertBefore(child, parent.childNodes[0]);

}


function loadSongs() {

	var mydiv = document.getElementById("songBox");
    console.log("SONG LENGTH" + songIdList.length);
	for(var i=0; i < songIdList.length; i++){
		var songId = songIdList[i];
		console.log("SONG ID"+songId);
		var newcontent = document.createElement('div');
    	newcontent.innerHTML = beginPlayer+songId+endPlayer;
    	

    	while (newcontent.firstChild) {
        	mydiv.appendChild(newcontent.firstChild);
    	}	
	}
}


function getSongId(url) {
var Request = new XMLHttpRequest();
Request.onreadystatechange = function () {
  if (this.readyState === 4 && this.status === 200) {
    console.log('Status:', this.status);
    console.log('Headers:', this.getAllResponseHeaders());
    console.log('Body:', this.responseText);     
    
    var textin = JSON.parse(this.responseText);
	var newSongId = parseSong(textin);
	addSong(newSongId);
  }
}

Request.open('GET', 'https://api.soundcloud.com/resolve.json?url='+url+'&client_id=dafab2de81f874d25715f0e225e7c71a', true);
Request.send(JSON.stringify(document.body));
}


function parseSong(trackJson) {
	console.log("PARSE SONG: "+trackJson);
	var id = JSON.stringify(trackJson["id"]);
	console.log("PARSESONG ID IS: "+id);
	
	return id;
}



