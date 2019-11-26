require('./bootstrap');

import Lyric from './components/show-song-lyric';
import Search from './components/form-search';
import AudioPlayer from './components/audio-player';
var vm = null;

if ((vm = document.getElementById('lyric'))) {
    const app = new Vue({
        el: '#lyric',
        data: {
            lyric: vm.dataset.lyric,
        },
        components: { lyric: Lyric },
        template: `<lyric :lyric="lyric"> </lyric>`,
    });
}

if ((vm = document.getElementById('search-form'))) {
    const searchFrom = new Vue({
        el: '#search-form',
        data: {
            action: vm.attributes.action.value,
            query: vm.attributes.query.value,
        },
        components: { 'search-form': Search },
        template: `<search-form :action="action" :query="query"> </search-form>`,
    });
}

if ((vm = document.getElementById('audio-player-container'))) {
    const audioPlayer = new Vue({
        el: '#audio-player-container',
        data: { src: vm.dataset.src },
        components: { AudioPlayer },
        template: `<AudioPlayer :src="src"></AudioPlayer>`,
    });
}
