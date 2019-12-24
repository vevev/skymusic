require('./bootstrap');

const SoundCloudPlayer = require('./components/downloadlagu123/soundclound-player').default;

var vm = null;

if ((vm = document.getElementById('soundclound-player-container'))) {
    const audioPlayer = new Vue({
        el: '#soundclound-player-container',
        data: { src: vm.dataset.src, retry: vm.dataset.retry },
        components: { SoundCloudPlayer },
        template: `<SoundCloudPlayer :src="src" :retry="retry"></SoundCloudPlayer>`,
    });
}
