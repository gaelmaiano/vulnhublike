const video = document.getElementById('video-background');
const playButton = document.getElementById('playButton');

playButton.addEventListener('click', () => {
    if (video.paused) {
        video.play();
        playButton.textContent = 'Pause';
    } else {
        video.pause();
        playButton.textContent = 'Play';
    }
});