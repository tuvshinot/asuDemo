<?php
    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            // encrypt pass first
            $pw = md5($pw);

            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");

            if(mysqli_num_rows($query)==1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        PUBLIC FUNCTION  register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            //validation
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validatelastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)) {
                // insert into db
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            } else {
                return false;
            }
        }

        // display error to UI
        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error="";
            }

            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPw = md5($pw); //password -> long string
            $profilePic = "assets/images/profile-pics/head_emerald.png";
            $date = date("Y-m-d");

            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
            // mysqli returns true or false that`s why below
            return $result;
        }

        private function validateUsername($un) {
            
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$usernameCharacters);
                return;
            }

            //check if username exists
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }

        }
        
        private function validateFirstName($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }

        private function validatelastName($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }

        private function validateEmails($em, $em2) {
            if($em != $em2) {
                array_push($this->errorArray, Constants::$emailsDoNotMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            //check if email is already used
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
            
        }   

        private function validatePasswords($pw, $pw2) {

            if($pw != $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNoMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) { // custum pattern of pass
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if(strlen($pw) > 25 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }
    }
?>

<script>
    $(document).ready(function() {
      var newPlaylist = <?php echo $jsonArray; ?>;
      audioElement = new Audio();
      setTrack(newPlaylist[0], newPlaylist, false);
      updateVolumeProgressBar(audioElement.audio);

        // prevent from default stuff highlighting
      $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
          e.preventDefault();
      });
      
    //   console.log(currentPlaylist)

        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if(mouseDown) {
                //set time of song, depending on position of mouse
                timeFromOffset(e, this);
            } 
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });


        /// volume bar stuff
        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e) {
            
            if(mouseDown) {
               var percentage = e.offsetX / $(this).width();

               if(percentage >=0 && percentage <=1) {
                    audioElement.audio.volume = percentage;
               }
            } 
        });

        $(".volumeBar .progressBar").mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();

               if(percentage >=0 && percentage <=1) {
                    audioElement.audio.volume = percentage;
               }
        });

        $(document).mouseup(function() {
            mouseDown = false;
        });
    });

function timeFromOffset(mouse, progresBar){
    var percentage = mouse.offsetX / $(progresBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function previousSong() {

    if(audioElement.audio.currentTime >=3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex--;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {

    if(repeat) {
        audioElement.setTime(0);
        playSong();
        return;
    }
    // not last song
    if(currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex]:currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? "repeat-active.png":"repeat.png";
    $(".controlButton.repeat img").attr("src", "assets/images/icon/" + imageName);
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "volume-mute.png":"volume.png";
    var imageTitle = audioElement.audio.muted ? "unmute":"mute";
    
    $(".controlButton.volume img").attr("src", "assets/images/icon/" + imageName);
    $(".controlButton.volume img").attr("title", imageTitle);
}

function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-active.png":"shuffle.png";
    var imageTitle = audioElement.audio.muted ? "unmute":"mute";
    $(".controlButton.shuffle img").attr("src", "assets/images/icon/" + imageName);

    if(shuffle) {
        // randomize playlist
        shuffleArray(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);

    } else {
        //shuffle has been deactivated
        //go back to regularplaylist
        currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    // return a;
}

function setTrack(trackId, newPlaylist, play) {
    
    if(newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }

    if(shuffle) {
        currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();
    
    $.post("includes/handlers/ajax/getSongJson.php", { songId:trackId }, function(data) {
        
        // see above we passed tarckId
        var track = JSON.parse(data);
        // console.log(track);
        $(".trackInfo .trackName span").text(track.title);
        

        // get artist via ajax call via id of artist
        $.post("includes/handlers/ajax/getArtistJson.php", { artistId:track.artists }, function(data) {
            var artist = JSON.parse(data);
            // console.log(artist);
            $(".trackInfo .artistName span").text(artist.name);
            $(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id+ "')");
        });

        // get album-> artwork via ajax call via id of artist
        $.post("includes/handlers/ajax/getAlbumJson.php", { albumId:track.album }, function(data) {
            var album = JSON.parse(data);
            // console.log(album);
            $(".content1 .albumLink img").attr("src", album.artworkPath);
            $(".content1 .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id+ "')");
            $("trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id+ "')");
        });


        audioElement.setTrack(track);
        // playSong();
        if(play) {
            playSong();
        }
    });
}

function playSong() {

    if(audioElement.audio.currentTime == 0) {
        // console.log("Updated time");
        $.post("includes/handlers/ajax/updatePlays.php", {songId:audioElement.currentlyPlaying.id});
    } 

    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}

</script>
