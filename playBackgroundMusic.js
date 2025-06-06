const music = document.getElementById("background-music");


document.addEventListener("click", function () {
    music.play();
}, { once: true });
  
window.onload = function () {
    if (localStorage.getItem("musicTime")) {
        music.currentTime = localStorage.getItem("musicTime");
    }
    if (localStorage.getItem("musicPlaying") === "true") {
         music.play();
    }
    if (localStorage.getItem("musicVolume")) {
        music.volume = localStorage.getItem("musicVolume");
    }
    if (localStorage.getItem("sliderValue")) {
        document.getElementById("volume-slider").value = localStorage.getItem("sliderValue");
    }


};
  

window.onbeforeunload = function () {
    localStorage.setItem("musicTime", music.currentTime);
    localStorage.setItem("musicPlaying", !music.paused);
};


function muteVolume(){
    document.getElementById("volume-slider").value = "0";
    music.volume = 0.0;
    localStorage.setItem("musicVolume", music.volume);
    localStorage.setItem("sliderValue","0");
    }


function adjustVolume(volume) {
    music.volume = volume;
    localStorage.setItem("musicVolume", music.volume);
    localStorage.setItem("sliderValue",volume);
    }
  


