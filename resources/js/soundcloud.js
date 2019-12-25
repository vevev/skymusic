window.Vue = require('vue');

const SoundCloudPlayer = require('./components/downloadlagu123/soundclound-player').default;

var vm = null;

if ((vm = document.getElementById('soundclound-player-container'))) {
    const audioPlayer = new Vue({
        el: '#soundclound-player-container',
        data: { ids: vm.dataset.ids },
        components: { SoundCloudPlayer },
        template: `<SoundCloudPlayer :ids="ids"></SoundCloudPlayer>`,
    });
}
