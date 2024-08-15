let currentIndex = 0;
let isPlay = false;
let isRamdom = false;
let isRepeat = false;
let songs = [];
let currentSong;
const root_url = `${window.location.protocol}//${window.location.host}/`;
const myModal = new bootstrap.Modal(crud_modal);

const CD = cd.animate([
  { transform: 'rotate(360deg)' }
], {
  duration: 10000,
  iterations: Infinity
});

const getList = async () => {
  var url = root_url + "song/getList";
  songs = (await axios.get(url)).data;
  currentSong = songs[currentIndex];
  const html = songs.map((song, index) => {
    return `
            <div class="song" data-index=${index}>
              <div class="thumb" style="background-image: url(${root_url + 'storage/image/' + song.image})">
              </div>
              <div class="body">
                <h3 class="title">${song.name}</h3>
                <p class="author">${song.singer}</p>
              </div>
              <div class="option">
                <div class="dropdown">      
                  <i class="fas fa-ellipsis-h" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
            
                  <ul class="dropdown-menu">
                    <li><button class="dropdown-item" onclick="openModalCRUD(${song.id})">Update</button></li>
                    <li><button class="dropdown-item" onclick="deleteSong(${song.id})">Delete</button></li>
                  </ul>
                </div>
              </div>
          </div>
            `
  }).join('');
  playlist.innerHTML = html;

}

const loadSong = () => {
  currentSong = songs[currentIndex];
  header.textContent = currentSong.name;
  cdThumb.style.backgroundImage = `url(${root_url + 'storage/image/' + currentSong.image})`;
  audio.src = root_url + 'storage/music/' + currentSong.music;
}

const reset = () => {
  player.classList.remove("playing");
  isPlay = false;
  progress.value = 0;
  audio.currentTime = 0;
  active();
  CD.pause();
}

const ramdomSong = () => {
  let index = currentIndex;
  do {
    currentIndex = Math.floor(Math.random() * songs.length);
  } while (index == currentIndex);
}

const active = () => {
  const song = playlist.querySelectorAll(".song");
  for (let i = 0; i < song.length; i++) {
    if (song[i].dataset.index == currentIndex) {
      song[i].classList.add("active");
    }
    else {
      song[i].classList.remove("active");
    }
  }
}

const handleEvent = () => {
  const cdWidth = cd.offsetWidth;
  CD.pause();

  document.onscroll = function () {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const newCdWidth = cdWidth - scrollTop;
    cd.style.width = newCdWidth > 0 ? newCdWidth + "px" : 0;
    cd.style.opacity = newCdWidth / cdWidth;
  };

  playbtn.onclick = function () {
    if (!isPlay) {
      audio.play();
    }
    else {
      audio.pause();
    }
  }

  audio.onplay = function () {
    isPlay = true;
    player.classList.add("playing");
    CD.play();
  }

  audio.onpause = function () {
    isPlay = false;
    player.classList.remove("playing");
    CD.pause();
  }

  audio.ontimeupdate = function () {
    if (!isNaN(audio.duration)) {
      progress.value = audio.currentTime / audio.duration * 100;
    }
  };

  audio.onended = function () {
    if (isRepeat) {
      audio.play();
    }
    else {
      nextbtn.onclick();
      audio.play();
    }
  }

  progress.onchange = function (e) {
    audio.currentTime = e.target.value * audio.duration / 100;
  };

  nextbtn.onclick = function () {
    if (isRamdom) {
      ramdomSong();
    }
    else {
      currentIndex++;
      if (currentIndex > songs.length - 1) {
        currentIndex = 0;
      }
    }
    loadSong();
    reset();

  }

  prebtn.onclick = function () {
    if (isRamdom) {
      ramdomSong();
    }
    else {
      currentIndex--;
      if (currentIndex < 0) {
        currentIndex = songs.length - 1;
      }
    }
    loadSong();
    reset();
  }

  ramdombtn.onclick = function () {
    isRamdom = !isRamdom;
    ramdombtn.classList.toggle("active", isRamdom);
  }

  repeatbtn.onclick = function () {
    isRepeat = !isRepeat;
    repeatbtn.classList.toggle("active", isRepeat);
  }

  playlist.onclick = function (e) {
    const song = e.target.closest('.song');
    if (song && !e.target.closest('.option')) {
      currentIndex = song.dataset.index;
      loadSong();
      reset();
    }
  }
}

const start = async () => {
  await getList();
  loadSong();
  handleEvent();
  active();
}

start();

const openModalCRUD = async (idSong) => {
  id.value = idSong
  const txt = idSong > 0 ? "CHỈNH SỬA" : "THÊM MỚI";
  modal_header.innerHTML = txt;
  myModal.show();
  if (idSong == 0) {
    form_add_edit.reset();
  }
  else {
    const url = root_url + "song/" + idSong + "/edit";
    const response = await axios.get(url);
    console.log(response.data);
    id.value = response.data.id;
    name.value = response.data.name;
    singer.value = response.data.singer;
    image.file = root_url + 'storage/image/' + response.data.image;
    music.src = root_url + 'storage/music/' + response.data.music;
  }
}

const save = async () => {
  var formData = new FormData(form_add_edit);

  try {
    const response = await axios.post(root_url + "song", formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    alert(response.data);
    myModal.hide();
    form_add_edit.reset();
    start();
  }
  catch (e) {
    console.log(e);
  }
}

const deleteSong = async (idSong) => {
  const url = root_url + "song/" + idSong;
  const res = await axios.delete(url);
  alert(res.data);
  start();
}
